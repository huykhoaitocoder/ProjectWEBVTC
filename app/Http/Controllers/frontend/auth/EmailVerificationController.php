<?php

namespace App\Http\Controllers\frontend\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Mail\VerifyEmailCode;

class EmailVerificationController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $email = $request->email;
        $otp = rand(100000, 999999); // Tạo OTP 6 số

        // Lưu OTP vào cache (hết hạn sau 8 phút)
        Cache::put('otp_' . $email, $otp, now()->addMinutes(8));

        // Gửi email
        Mail::to($email)->send(new VerifyEmailCode($otp));

        return response()->json(['success' => true, 'message' => 'Mã OTP đã được gửi.']);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric',
        ]);

        $email = $request->email;
        $inputOtp = $request->otp;
        $storedOtp = Cache::get('otp_' . $email);

        if (!$storedOtp || $inputOtp != $storedOtp) {
            return response()->json(['success' => false, 'message' => 'Mã OTP không hợp lệ hoặc đã hết hạn.']);
        }

        // Xóa OTP sau khi xác thực
        Cache::forget('otp_' . $email);

        return response()->json(['success' => true, 'message' => 'Xác thực thành công.']);
    }
}
