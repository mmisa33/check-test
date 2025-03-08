<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // お問い合わせフォーム入力ページ表示
    public function index()
    {
        return view('index');
    }

    // お問い合わせフォーム入力ページ表示
    public function confirm()
    {
        return view('confirm');
    }
}
