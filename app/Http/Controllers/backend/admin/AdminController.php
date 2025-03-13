<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Developer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        return view('Backend.admin.admin.dashboard');
    }

}
