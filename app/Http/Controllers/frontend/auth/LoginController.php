<?php

namespace App\Http\Controllers\frontend\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function __construct(){
        $seoData['title'] = "Đăng nhập tài khoản cho Cửa hàng ứng dụng APKRebel Play";
        $seoData['canonical'] = url('/login');

        $this->middleware('guest')->except('logout');

        view()->share([
            'seoData' => $seoData
        ]);
    }

    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_email' => 'required|email',
            'user_password' => 'required|string|min:6',
        ]);

        if (Auth::attempt(['email' => $credentials['user_email'], 'password' => $credentials['user_password']])) {
            $request->session()->regenerate();
            $user = Auth::user(); // Lấy ra user hiện tại

            if ($user->role === "admin") {
                return redirect()->route('admin.dashboard')->with('success', 'Chào mừng Admin quay lại!');
            } else {
                return redirect()->intended('/')->with('success', 'Đăng nhập thành công!');
            }
        }

        return back()->withErrors([
            'user_email' => 'Email hoặc mật khẩu không đúng.',
        ])->withInput();
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Đăng xuất thành công.');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback() {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
            ]
        );

        Auth::login($user);

        return redirect('/')->with('success', 'Đăng nhập với Google thành công!');
    }
}
