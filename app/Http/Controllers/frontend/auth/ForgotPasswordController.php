<?php

namespace App\Http\Controllers\frontend\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function __construct(){
        $seoData['title'] = "Quên mật khẩu tài khoản APKRebel Play";
        $seoData['canonical'] = url('/forgot-password');
        
        view()->share([
            'seoData' => $seoData
        ]);
    }

    public function showLinkRequestForm()
    {
        return view('frontend.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
