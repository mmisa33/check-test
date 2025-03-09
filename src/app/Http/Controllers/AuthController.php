<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    // 登録ページの表示
    public function index()
    {
        return view('auth.register');
    }
}