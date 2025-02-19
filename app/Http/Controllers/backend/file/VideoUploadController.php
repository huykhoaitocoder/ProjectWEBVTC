<?php

namespace App\Http\Controllers\backend\file;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class VideoUploadController extends Controller
{
    public function uploadForm()
    {
        return view('backend.file.video');
    }

    public function uploadVideo(Request $request)
    {
        $request->validate([
            'video_file' => 'required|mimes:mp4,mov,avi,wmv|max:102400', 
        ], [
            'video_file.required' => 'Vui lòng chọn file video.',
            'video_file.mimes' => 'Chỉ cho phép định dạng mp4, mov, avi, wmv.',
            'video_file.max' => 'Video không được vượt quá 100MB.',
        ]);

        $uploadedVideo = Cloudinary::uploadFile(
            $request->file('video_file')->getRealPath(),
            ['resource_type' => 'video']
        );

        return back()->with('success', 'Tải video thành công! URL: ' . $uploadedVideo->getSecurePath());
    }
}
