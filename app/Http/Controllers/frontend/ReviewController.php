<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct(){
        $seoData = [
            'title' => 'Đánh giá - VH APK',
            'canonical' => url('/')
        ];

        view()->share([
            'seoData' => $seoData,
        ]);
    }

    public function create(App $app)
    {
        return view('frontend.reviews.create', compact('app'));
    }

    public function edit(Request $request, Review $review)
    {
        $this->authorize('update', $review); // Đảm bảo user có quyền chỉnh sửa

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Cập nhật đánh giá
        $review->update($validated);

        // Trả về JSON cho fetch (AJAX)
        return response()->json(['success' => true, 'message' => 'Đánh giá đã được cập nhật.']);
    }

    public function update(Request $request, Review $review)
    {
        $this->authorize('update', $review);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $review->update($request->only('rating', 'comment'));

        return response()->json(['success' => true]);
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        $review->delete(); //  soft delete, k xóa hẳn

        return redirect()->back()->with('success', 'Đánh giá đã được ẩn.');
    }

    public function store(Request $request, App $app)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'app_id' => $app->id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json(['success' => true]);
    }
}
