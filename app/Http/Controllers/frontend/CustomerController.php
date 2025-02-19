<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct(){
        $seoData['title'] = "Đăng nhập tài khoản cho Cửa hàng ứng dụng APKRebel Play";
        $seoData['canonical'] = url('/login');
    
        view()->share([
            'seoData' => $seoData
        ]);
    }
    
    public function index(){
        if(Auth::check()){
            return redirect('/customer/profile');
        }
        else{
            return view('frontend.customer.login');
        }
    }
}
