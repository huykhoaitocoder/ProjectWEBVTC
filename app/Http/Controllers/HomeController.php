<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::paginate(9); // 9 sản phẩm mỗi trang
        return view('Frontend.home', compact('products'));
    }


}
