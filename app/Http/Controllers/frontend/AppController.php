<?php

namespace App\Http\Controllers\frontend;

use App\Models\App;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppController extends Controller
{
    public function index()
    {
    //
    }

    public function show($id) {
        
        $app = App::findOrFail($id);
        $userHasPurchased = false; 

        if (auth()->check()) {
            $userHasPurchased = auth()->user()->purchases()->where('app_id', $id)->exists();
        }      

        $seoData['title'] = $app->name . ' - Ứng dụng';
        $seoData['canonical'] = url('/apps/' . $id);

        return view('frontend.apps.details', compact('app', 'userHasPurchased', 'seoData'));
    }
}
