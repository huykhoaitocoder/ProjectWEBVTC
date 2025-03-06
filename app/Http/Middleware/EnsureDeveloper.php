<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureDeveloper
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->developer || Auth::user()->developer->status !== 'approved') {
            return redirect()->route('home')->with('error', 'Bạn chưa được cấp quyền Developer!');
        }
        return $next($request);
    }
}
