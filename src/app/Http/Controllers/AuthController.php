<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    // 入力したデータの保存
    public function store(RegisterRequest $request)
    {
        $user = $request->only(['name', 'email', 'password']);
        User::create($user);

        return redirect()->route('login');
    }

    public function login()
    {
        return view('auth.login');
    }
}