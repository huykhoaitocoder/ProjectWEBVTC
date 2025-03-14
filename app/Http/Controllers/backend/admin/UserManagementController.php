<?php

namespace App\Http\Controllers\backend\admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Tìm kiếm theo tên hoặc email
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        // Lọc theo vai trò
        if ($request->has('role') && in_array($request->role, ['admin', 'developer', 'user', 'baned'])) {
            $query->where('role', $request->role);
        }

        $users = $query->paginate(10); // Phân trang mỗi trang 10 user

        return view('Backend.admin.admin.user_management', compact('users'));
    }
    // Hiển thị thông tin chi tiết của user
    public function showUserDetail($id)
    {
        $user = User::findOrFail($id);
        return view('Backend.admin.admin.user_details', compact('user'));
    }

    // Cập nhật vai trò của user
    public function updateUserRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:user,dev,admin,ban',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật vai trò thành công.');
    }
}
