<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    // 管理画面表示
    public function index()
    {
        $contacts = Contact::with('category')->get();
        $categories = Category::all();

        $contacts = Contact::paginate(7);

        return view('admin', compact('contacts', 'categories'));
    }

    public function export()
    {
        $contacts = Contact::all();

        // CSV形式でデータを作成
        $csvContent = "お名前, 性別, メールアドレス, お問い合わせの種類\n";

        foreach ($contacts as $contact) {
            $csvContent .= "{$contact->last_name} {$contact->first_name}, "
                . ($contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他')) . ", "
                . "{$contact->email}, "
                . "{$contact->category->content}\n";
        }

        // ヘッダを設定してCSVをダウンロード
        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ]);
    }

}
