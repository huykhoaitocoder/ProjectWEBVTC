<?php

namespace App\Http\Controllers\backend;

use App\Models\Coupon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function __construct(){
        $seoData = [
            'title' => 'Mã giảm giá - Developer VH APK',
            'canonical' => url('/developer/coupons')
        ];

        view()->share([
            'seoData' => $seoData,
        ]);
    }

    public function index()
    {
        $coupons = Coupon::orderBy('created_at', 'desc')->get();
        return view('backend.developer.coupons.list', compact('coupons'));
    }

    public function create()
    {
        $apps = auth()->user()->developer->apps; 
        return view('backend.developer.coupons.create', compact('apps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'app_id' => 'required|exists:apps,id',
            'code' => 'required|string|max:50|unique:coupons,code',
            'discount_percentage' => 'required|integer|between:1,100',
            'max_usage' => 'required|integer|min:1',
            'expiration_date' => 'required|date|after:today',
        ]);

        Coupon::create([
            'app_id' => $request->app_id,
            'code' => strtoupper($request->code),
            'discount_percentage' => $request->discount_percentage,
            'max_usage' => $request->max_usage,
            'expiration_date' => $request->expiration_date,
            'status' => 'active',
        ]);

        return redirect()->route('developer.coupons.create')->with('success', 'Coupon created successfully!');
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('developer.coupons.list')->with('success', 'Mã giảm giá đã được xóa.');
    }
}
