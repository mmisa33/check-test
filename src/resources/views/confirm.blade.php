@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <!-- ページタイトル -->
    <div class="confirm__heading">
        <h2>Confirm</h2>
    </div>

    <!-- 問い合わせ確認テーブル -->
    <form class="form" action="/" method="post">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <!-- 名前 -->
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        <input type="text" name="name" value="{{ $contact['last_name'] . '　　' . $contact['first_name'] }}" readonly>
                    </td>
                </tr>

                <!-- 性別 -->
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        <input type="text" name="gender" value="@if($contact['gender'] == 1)男性 @elseif($contact['gender'] == 2)女性 @elseif($contact['gender'] == 3)その他 @endif" readonly>
                    </td>
                </tr>

                <!-- メールアドレス -->
                <tr class=" confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        <input type="email" name="email" value="{{ $contact['email'] }}" readonly>
                    </td>
                </tr>

                <!-- 電話番号 -->
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        <input type="tel" name="tel" value="{{ $contact['tel'] ?? '' }}" readonly>
                    </td>
                </tr>

                <!-- 住所 -->
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        <input type="text" name="address" value="{{ $contact['address'] }}" readonly>
                    </td>
                </tr>

                <!-- 建物名 -->
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <input type="text" name="building" value="{{ $contact['building'] }}" readonly>
                    </td>
                </tr>

                <!-- 問い合わせ種類 -->
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        <input type="text" name="category_id" value="{{ $category->content }}" readonly>
                    </td>
                </tr>

                <!-- 問い合わせ内容 -->
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        <textarea name="detail" readonly>{{ $contact['detail'] }}</textarea>
                    </td>
                </tr>
            </table>
        </div>

        <!-- ボタン -->
        <div class="form__button">
            <!-- 送信 -->
            <button class="form__button-submit" type="submit">送信</button>
            <!-- 修正 -->
            <a href="/" class="form__button-edit">修正</a>
        </div>
    </form>
</div>
@endsection