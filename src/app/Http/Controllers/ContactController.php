<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    // お問い合わせフォーム入力ページ表示
    public function index()
    {
        return view('index');
    }

    // お問い合わせフォーム入力ページ表示
    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['category_id','first_name','last_name','gender','email','tel','address','building','detail']);
        return view('confirm', ['contact' => $contact]);
    }
}
