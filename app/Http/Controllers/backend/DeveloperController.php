<?php

namespace App\Http\Controllers\backend;

use App\Models\Developer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeveloperController extends Controller
{
    public function index()
    {
        $developers = Developer::where('status', 'pending')->get();
        return view('admin.developers.index', compact('developers'));
    }

    public function approve($id)
    {
        Developer::where('id', $id)->update(['status' => 'approved']);
        return back()->with('success', 'Tài khoản Developer đã được duyệt!');
    }

    public function reject($id)
    {
        Developer::where('id', $id)->update(['status' => 'rejected']);
        return back()->with('error', 'Tài khoản Developer đã bị từ chối!');
    }

    public function showRegistrationForm()
    {
        return view('backend.developer.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', 
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'website' => 'nullable|url',
        ]);
        
        Developer::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'website' => $request->website,
            'status' => 'pending',
        ]);        

        return redirect()->route('dashboard')->with('success', 'Đăng ký Developer thành công! Vui lòng chờ duyệt.');
    }
}
