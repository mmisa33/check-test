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
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    // 検索機能
    public function search(Request $request)
    {
        $contacts = Contact::query()
            ->categorySearch($request->category_id)
            ->keywordSearch($request->keyword)
            ->genderSearch($request->gender)
            ->dateSearch($request->date)
            ->paginate(7);

        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    // CSVエクスポート機能
    public function export()
    {
        $contacts = Contact::all();

        // CSVヘッダー
        $headers = ['苗字', '名前', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容'];

        $handle = fopen('php://output', 'w');

        // HTTPヘッダーを設定
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="contacts.csv"');
        header('Cache-Control: max-age=0');

        // ヘッダーをCSVに書き込む
        fputcsv($handle, $headers);

        // 絞り込んだ連絡先をCSVに書き込む
        foreach ($contacts as $contact) {
            fputcsv($handle, [
                strip_tags($contact->last_name),
                strip_tags($contact->first_name),
                $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他'),
                strip_tags($contact->email),
                strip_tags($contact->tel_area) . '-' . strip_tags($contact->tel_number) . '-' . strip_tags($contact->tel_end),
                strip_tags($contact->address),
                strip_tags($contact->building),
                strip_tags($contact->category->content),
                strip_tags($contact->detail),
            ]);
        }

        // ストリームとしてCSVファイルを返す
        return response()->stream(
            function () use ($handle) {
                fclose($handle);
            },
            200,
            [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=contacts.csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            ]
        );
    }
}