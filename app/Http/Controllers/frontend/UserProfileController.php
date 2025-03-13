<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $seoData['title'] = "Thông tin cá nhân - VH APK";
        $seoData['canonical'] = url('/profile');
        
        view()->share([
            'seoData' => $seoData
        ]);
    }
    public function edit()
    {
        return view('frontend.user.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
        ]);

        Auth::user()->update($request->only(['full_name', 'phone', 'address', 'website']));

        return back()->with('success', 'Hồ sơ đã được cập nhật thành công!');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png,gif|max:5048',
        ]);

        $user = auth()->user();

        if ($user->avatar) {
            $oldPath = str_replace(Storage::disk('s3')->url(''), '', $user->avatar);
            Storage::disk('s3')->delete($oldPath);
        }

        $avatarPath = $request->file('avatar')->store('avatars', 's3');
        $avatarUrl = Storage::disk('s3')->url($avatarPath);

        $user->update(['avatar' => $avatarUrl]);

        return back()->with('success', 'Ảnh đại diện đã được cập nhật thành công!');
    }
}
