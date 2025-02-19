<?php

namespace App\Http\Controllers\backend\file;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class APKUploadController extends Controller
{
    public function uploadForm()
    {
        return view('backend.upload.apk');
    }

    public function uploadApk(Request $request)
    {
        $request->validate([
            'apk_file' => 'required|mimes:apk|max:51200', 
        ], [
            'apk_file.required' => 'Vui lòng chọn file APK.',
            'apk_file.mimes' => 'Chỉ cho phép file định dạng APK.',
            'apk_file.max' => 'File không được vượt quá 50MB.',
        ]);

        $uploadedFile = Cloudinary::uploadFile(
            $request->file('apk_file')->getRealPath(),
            ['resource_type' => 'raw']
        );

        return back()->with('success', 'Tải lên thành công! URL: ' . $uploadedFile->getSecurePath());
    }
}
