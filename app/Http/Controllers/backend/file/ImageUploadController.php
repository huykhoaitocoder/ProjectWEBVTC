<?php

namespace App\Http\Controllers\backend\file;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Api\Exception\ApiErrorException; 

class ImageUploadController extends Controller
{
    public function uploadForm() {
        return view('backend.upload.image');
    }

    public function uploadImages(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);
    
        $urls = [];
    
        try {
            foreach ($request->file('images') as $image) {
                $uploadedImage = Cloudinary::uploadApi()->upload($image->getRealPath(), [
                    'folder' => 'uploaded_images'
                ]);
    
                $urls[] = $uploadedImage['secure_url'];
            }
    
            return back()->with('success', 'Tải lên thành công!')->with('urls', $urls);
    
        } catch (ApiErrorException $e) {
            return back()->with('error', 'Tải lên thất bại: ' . $e->getMessage());
        } catch (\Exception $e) {
            return back()->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
        }
    }
}
