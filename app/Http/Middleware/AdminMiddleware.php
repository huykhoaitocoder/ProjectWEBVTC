<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Xử lý request để kiểm tra quyền admin.
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu user chưa đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập!');
        }

        // Kiểm tra nếu user không phải admin
        if (Auth::user()->role !== 'admin') {
            return response()->view('errors.403', [], 403); // Thay vì abort(403)
        }

        return $next($request);
    }
}
