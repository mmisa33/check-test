<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 管理画面表示
    public function index()
    {
        return view('admin.dashboard');
    }
}
