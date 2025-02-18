<?php

namespace App\Http\Controllers\frontend;

use App\Models\App;
use App\Models\Slider;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function __construct(){
        $categories = Category::where('status', 'active')->get();

        // Lấy thông tin người dùng nếu đang đăng nhập
        // $user = auth()->user();

        $seoData = [
            'title' => 'APKRebel Play - Kho ứng dụng',
            'description' => 'Tải ứng dụng Android miễn phí, game mobile, ứng dụng trả phí, ứng dụng hack, mod, crack, ứng dụng đã gỡ và phiên bản cũ.',
            'keywords' => ['APKRebel Play', 'ứng dụng Android', 'game mobile', 'ứng dụng hack', 'mod', 'crack'],
            'canonical' => url('/')
        ];

        view()->share([
            'categories' => $categories,
            'seoData' => $seoData,
            // 'user' => $user
        ]);
    }

    public function index() {
        $topApps = App::orderBy('total_downloads', 'DESC')->limit(6)->get();
        $newApps = App::orderBy('created_at', 'DESC')->limit(6)->get();
        $freeApps = App::where('price', 0)->orderBy('total_downloads', 'DESC')->limit(6)->get();
        $paidApps = App::where('price', '>', 0)->orderBy('total_downloads', 'DESC')->limit(6)->get();
        $topRatedApps = App::orderBy('average_rating', 'DESC')->limit(6)->get();
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
