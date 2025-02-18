<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $data = User::orderBy('user_id', 'DESC')->paginate(10);

        return view('backend.users.list', ['data' => $data]);
    }
}
