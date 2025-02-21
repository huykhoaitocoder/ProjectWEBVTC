<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function __construct(){
        $seoData = [
            'title' => 'Thông báo',
            'canonical' => url('/notifications')
        ];

        view()->share([
            'seoData' => $seoData,
        ]);
    }

    public function index() {
        $notifications = auth()->user()->notifications()->latest()->get();
        return view('frontend.notifications.index', compact('notifications'));
    }

    public function markAsRead($id) {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->update(['is_read' => true]);
        return back();
    }
}
