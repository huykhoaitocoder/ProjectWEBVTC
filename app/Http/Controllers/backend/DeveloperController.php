<?php

namespace App\Http\Controllers\backend;

use Log;
use App\Models\App;
use App\Models\Category;
use App\Models\Developer;
use App\Models\AppVersion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DeveloperController extends Controller
{
    // public function reject($id)
    // {
    //     Developer::where('id', $id)->update(['status' => 'rejected']);
    //     return back()->with('error', 'Tài khoản Developer đã bị từ chối!');
    // }

    public function dashboard()
    {
        return view('backend.developer.dashboard.index');
    }

    public function create() {
        $categories = Category::all();
        
        return view('backend.developer.apps.create', compact('categories'));
    }

    public function store(Request $request) {
        $iconPath = $request->file('icon') ? $request->file('icon')->store('icons', 's3') : null;

        $app = App::create([
            'developer_id' => Auth::id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'package_name' => $request->package_name,
            'description' => $request->description,
            'price' => $request->price,
            'icon' => $iconPath,
            'status' => 'pending', 
        ]);

        $apkFile = $request->file('apk');
        $apkPath = "apps/{$app->id}/versions/" . $apkFile->getClientOriginalName();
        
        Storage::disk('s3')->put($apkPath, file_get_contents($apkFile), [
            'ContentType' => 'application/vnd.android.package-archive',
        ]);
    
        $apkSize = $apkFile->getSize();

        $screenshots = [];
        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $screenshot) {
                $path = "apps/{$app->id}/screenshots/" . $screenshot->getClientOriginalName();
                Storage::disk('s3')->put($path, file_get_contents($screenshot));
                $screenshots[] = $path;
            }
        }

        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoFile = $request->file('video');
            $videoPath = "apps/{$app->id}/videos/" . $videoFile->getClientOriginalName();
            Storage::disk('s3')->put($videoPath, file_get_contents($videoFile));
        }

        AppVersion::create([
            'app_id' => $app->id,
            'version_name' => $request->version_name,
            'changelog' => $request->changelog,
            'apk_path' => $apkPath,
            'file_size' => $apkSize,
            'screenshots' => $screenshots,
            'video' => $videoPath,
            'status' => 'pending', 
        ]);

        return redirect()->route('developer.apps')->with('success', 'Ứng dụng đã được tạo và chờ phê duyệt!');
    }

    public function list() {
        $apps = App::where('developer_id', auth()->id())->get();
        return view('backend.developer.apps.list', compact('apps'));
    }

    public function showRegistrationForm()
    {
        if (auth()->check() && auth()->user()->role === 'developer') {
            return redirect()->route('developer.dashboard');
        }

        $seoData = [
            'title' => "Đăng ký Developer VH APK",
            'canonical' => url('/developer/register'),
        ];

        view()->share('seoData', $seoData);
        
        return view('backend.developer.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => [
                'required', 
                'string', 
                'max:50',
                'regex:/^[\pL\s\d\-]+$/u'
            ],
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:100|unique:developers,email',
            'phone' => 'required|string|max:20|unique:developers,phone',
            'address' => 'required|string|max:255',
            'website' => 'nullable|url',
        ]);

        if (Developer::where('user_id', Auth::id())->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn đã là Developer!'
            ], 400);
        }

        $user = auth()->user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy người dùng'], 404);
        }

        Developer::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'website' => $request->website,
        ]);
        
        $user->update(['role' => 'developer']);

        return response()->json([
            'success' => true,
            'message' => 'Đăng ký Developer thành công!',
            'redirect' => route('developer.dashboard')
        ]);
    }

    public function checkName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50'
        ]);

        $exists = Developer::where('name', $request->name)->exists();

        return response()->json([
            'exists' => $exists,
            'message' => $exists ? 'Tên này đã được sử dụng!' : 'Tên hợp lệ!'
        ]);
    }
}
