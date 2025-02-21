<?php

namespace App\Http\Controllers\frontend\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token)
    {
        return view('frontend.auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            fn($user) => $user->forceFill(['password' => Hash::make($request->password)])->save()
        );

        return $status === Password::PASSWORD_RESET
        ? redirect('/login')->with('success', 'Đặt lại mật khẩu thành công!')
        : back()->withErrors(['email' => __($status)]);
    }
}
