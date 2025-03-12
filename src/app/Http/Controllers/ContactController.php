<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    // お問い合わせフォーム入力ページ表示
    public function index()
    {
        $contacts = Contact::with('category')->get();
        $categories = Category::all();

        return view('index', compact('contacts', 'categories'));
    }

    // お問い合わせフォーム確認ページ表示
    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['category_id', 'first_name', 'last_name', 'gender', 'email', 'tel_area', 'tel_number', 'tel_end', 'address', 'building', 'detail']);
        $category = Category::find($contact['category_id']);

        return view('confirm', compact('contact', 'category'));
    }

    // 入力したお問い合わせデータの保存
    public function store(ContactRequest $request)
    {
        $contact = $request->only(['category_id', 'first_name', 'last_name', 'gender', 'email', 'tel_area', 'tel_number', 'tel_end', 'address', 'building', 'detail']);
        Contact::create($contact);

        return view('thanks');
    }
}