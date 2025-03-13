<?php

namespace App\Http\Controllers\frontend\auth;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct(){
        $seoData['title'] = "Đăng ký tài khoản cho Cửa hàng ứng dụng VH APK";
        $seoData['canonical'] = url('/register');
        
        $this->middleware('guest');

        view()->share([
            'seoData' => $seoData
        ]);
    }

    public function showRegistrationForm() {
        return view('frontend.auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email:rfc,dns|max:50|unique:users,email',
            'password' => 'required|min:6|max:20',
            'password_confirmation' => 'required|same:password',
        ],[
            'name.required' => 'Họ tên không được để trống',
            'email.required' => 'Email không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'password_confirmation.required' => 'Mật khẩu xác nhận không được để trống',
            'name.min' => 'Họ tên quá ngắn phải lớn hơn 5 kí tự',
            'name.max' => 'Họ tên quá dài phải nhỏ hơn 50 kí tự',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được sử dụng',
            'email.max' => 'Email quá dài',
            'password.min' => 'Mật khẩu quá ngắn phải lớn hơn 5 kí tự',
            'password.max' => 'Mật khẩu quá dài phải nhỏ hơn 20 kí tự',
            'password_confirmation.same' => 'Mật khẩu xác nhận không khớp',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        UserProfile::create([
            'user_id' => $user->id,
            'full_name' => null,
            'phone' => null,
            'address' => null,
            'bio' => null,
            'social_links' => null,
        ]);

        Auth::login($user); 
        return redirect('/')->with('success', 'Đăng ký thành công!');
    }
}
