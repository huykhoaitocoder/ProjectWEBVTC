<?php

namespace App\Http\Controllers\backend\admin;

use App\Models\App;
use App\Models\Category;
use App\Models\Developer;
use App\Models\Screenshot;
use App\Models\AppVersion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppManagementController extends Controller
{
    // Hiển thị danh sách ứng dụng
    public function index(Request $request)
    {
        $query = App::with(['category', 'developer'])->withCount('downloads');

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('id', $request->search);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $apps = $query->paginate(10);

        return view('Backend.admin.admin.app_management', compact('apps'));
    }
    public function updateStatus(Request $request, App $app)
    {
        $request->validate([
            'status' => 'required|in:approved,pending,rejected',
        ]);

        $app->update(['status' => $request->status]);

        return back()->with('success', 'Trạng thái ứng dụng đã được cập nhật.');
    }

    public function getAppDetails($id)
    {
        $app = App::with(['category', 'developer', 'versions', 'downloads', 'reviews'])->findOrFail($id);
        return view('Backend.admin.admin.app_details', compact('app'));
    }

}
