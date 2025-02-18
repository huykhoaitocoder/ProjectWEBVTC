<?php

namespace App\Http\Controllers\frontend;

use App\Models\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppController extends Controller
{
    public function index()
    {
    //
    }

    public function show($id)
    {
        $app = App::findOrFail($id);
        return view('frontend.apps.details', compact('app'));
    }
}
