<?php

namespace App\Http\Controllers\frontend;

use App\Models\App;
use App\Models\Slider;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct(){
        $categories = Category::where('status', 'active')->get();

        // Lấy thông tin người dùng nếu đang đăng nhập
        // $user = auth()->user();

        $seoData = [
            'title' => 'VH APK - Kho ứng dụng',
            'canonical' => url('/')
        ];

        view()->share([
            'categories' => $categories,
            'seoData' => $seoData,
            // 'user' => $user
        ]);
    }

    public function index() {
        $topApps = App::where('status', 'approved')->orderBy('total_downloads', 'DESC')->limit(25)->get();
        $newApps = App::where('status', 'approved')->orderBy('created_at', 'DESC')->limit(15)->get();
        $freeApps = App::where('status', 'approved')->where('price', 0)->orderBy('total_downloads', 'DESC')->limit(20)->get();
        $paidApps = App::where('status', 'approved')->where('price', '>', 0)->orderBy('total_downloads', 'DESC')->limit(25)->get();
        $topRatedApps = App::where('status', 'approved')->orderBy('average_rating', 'DESC')->limit(30)->get();
        $sliders = Slider::where('status', 'active')->orderBy('position', 'ASC')->get();
    
        return view('frontend.pages.home', [
            'topApps' => $topApps,
            'newApps' => $newApps,
            'freeApps' => $freeApps,
            'paidApps' => $paidApps,
            'topRatedApps' => $topRatedApps,
            'sliders' => $sliders
        ]);
    }
}
