<?php

namespace App\Http\Controllers\Backend;

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
        return view('Backend.developer.dashboard.index');
    }

    public function create() {
        $categories = Category::all();

        return view('Backend.developer.apps.create', compact('categories'));
    }

    public function store(Request $request) {
        $user = Auth::user();

        if ($user->developer) {
            $developerId = $user->developer->id; 
        } else {
            return redirect()->back()->with('error', 'Bạn không phải là nhà phát triển.');
        }

        $iconPath = $request->file('icon') ? $request->file('icon')->store('icons', 's3') : null;
        $iconUrl = $iconPath ? Storage::disk('s3')->url($iconPath) : null;  

        $app = App::create([
            'developer_id' => $developerId,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'package_name' => $request->package_name,
            'description' => $request->description,
            'price' => $request->price,
            'icon' => $iconUrl,  
            'status' => 'pending', 
        ]);
    
        $apkFile = $request->file('apk');
        $apkPath = "apps/{$app->id}/versions/" . $apkFile->getClientOriginalName();
        Storage::disk('s3')->put($apkPath, file_get_contents($apkFile), [
            'ContentType' => 'application/vnd.android.package-archive',
        ]);
        $apkUrl = Storage::disk('s3')->url($apkPath);
    
        $apkSize = $apkFile->getSize();
    
        $screenshots = [];
        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $screenshot) {
                $path = "apps/{$app->id}/screenshots/" . $screenshot->getClientOriginalName();
                Storage::disk('s3')->put($path, file_get_contents($screenshot));
                $screenshots[] = Storage::disk('s3')->url($path);  
            }
        }
    
        $videoId = null;
        if ($request->hasFile('video')) {
            $videoFile = $request->file('video');
            $videoId = $this->uploadToYouTube($videoFile, $request->name, $request->description);
        }
        
        AppVersion::create([
            'app_id' => $app->id,
            'version_name' => $request->version_name,
            'changelog' => $request->changelog,
            'apk_path' => $apkUrl,  
            'file_size' => $apkSize,
            'screenshots' => $screenshots,
            'video' => $videoId,
            'status' => 'pending', 
        ]);
    
        return redirect()->route('developer.apps')->with('success', 'Ứng dụng đã được tạo và chờ phê duyệt!');
    }    

    private function uploadToYouTube($videoFile, $title, $description) {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('youtube_client_secret.json'));
        $client->addScope(Google_Service_YouTube::YOUTUBE_UPLOAD);
        $client->setAccessType('offline');
    
        $youtube = new Google_Service_YouTube($client);
        
        $video = new Google_Service_YouTube_Video();
        $video->setSnippet(new Google_Service_YouTube_VideoSnippet([
            'title' => $title,
            'description' => $description,
            'tags' => ['app', 'android'],
            'categoryId' => '28' // 28 = Tech
        ]));
    
        $video->setStatus(new Google_Service_YouTube_VideoStatus([
            'privacyStatus' => 'public'
        ]));
    
        $chunkSizeBytes = 1 * 1024 * 1024;
        $client->setDefer(true);
        $insertRequest = $youtube->videos->insert('status,snippet', $video);
        $media = new Google_Http_MediaFileUpload(
            $client,
            $insertRequest,
            'video/*',
            null,
            true,
            $chunkSizeBytes
        );
    
        $media->setFileSize(filesize($videoFile));
        $status = false;
        $handle = fopen($videoFile, 'rb');
        
        while (!$status && !feof($handle)) {
            $chunk = fread($handle, $chunkSizeBytes);
            $status = $media->nextChunk($chunk);
        }
    
        fclose($handle);
        $client->setDefer(false);
    
        return $status->id; 
    }

    public function list()
    {
        $developer = auth()->user()->developer;
        
        if (!$developer) {
            return redirect()->route('developer.register')->with('error', 'Bạn không phải là nhà phát triển.');
        }

        $apps = App::where('developer_id', $developer->id)->get();

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

        return view('Backend.developer.auth.register');
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
