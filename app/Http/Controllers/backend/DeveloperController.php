<?php

namespace App\Http\Controllers\backend;

use Log;
use App\Models\Developer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeveloperController extends Controller
{
    public function index()
    {
        // $developers = Developer::where('status', 'pending')->get();
        // return view('admin.developers.index', compact('developers'));
    }

    // public function reject($id)
    // {
    //     Developer::where('id', $id)->update(['status' => 'rejected']);
    //     return back()->with('error', 'Tài khoản Developer đã bị từ chối!');
    // }

    public function dashboard()
    {
        return view('backend.developer.dashboard.index');
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
            return redirect()->back()->with('error', 'Bạn đã là Developer!');
        }

        $user = auth()->user(); 

        if (!$user->developer) {
            Developer::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'website' => $request->website,
            ]);
        
        if ($user) {
            $user->update(['role' => 'developer']);
        } else {
            return response()->json(['error' => 'Không tìm thấy người dùng'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Đăng ký Developer thành công!',
            'redirect' => route('developer.dashboard')
        ]);
        }
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
