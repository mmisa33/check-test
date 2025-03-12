@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    {{--  ページタイトル  --}}
    <div class="confirm__heading">
        <h2>Confirm</h2>
    </div>

    {{--  問い合わせ確認テーブル  --}}
    <form class="form" action="/thanks" method="post">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                {{--  名前  --}}
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        <span>{{ $contact['last_name'] . '    ' . $contact['first_name'] }}</span>
                        {{--  隠しフィールドで実際のデータを送信   --}}
                        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                    </td>
                </tr>

                {{--  性別  --}}
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        <span>{{ ['1' => '男性', '2' => '女性', '3' => 'その他'][$contact['gender']] }}</span>
                        {{--  隠しフィールドで実際のデータを送信   --}}
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                    </td>
                </tr>

                {{--  メールアドレス  --}}
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        <span>{{ $contact['email'] }}</span>
                        {{--  隠しフィールドで実際のデータを送信   --}}
                        <input type="hidden" name="email" value="{{ $contact['email'] }}">
                    </td>
                </tr>

                {{--  電話番号  --}}
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        <span>{{ $contact['tel_area'] . '' . $contact['tel_number'] . '' . $contact['tel_end'] }}</span>
                        {{--  隠しフィールドで実際のデータを送信  --}}
                        <input type="hidden" name="tel_area" value="{{ $contact['tel_area'] }}">
                        <input type="hidden" name="tel_number" value="{{ $contact['tel_number'] }}">
                        <input type="hidden" name="tel_end" value="{{ $contact['tel_end'] }}">
                    </td>
                </tr>

                {{--  住所  --}}
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        <span>{{ $contact['address'] }}</span>
                        {{--  隠しフィールドで実際のデータを送信  --}}
                        <input type="hidden" name="address" value="{{ $contact['address'] }}">
                    </td>
                </tr>

                {{--  建物名  --}}
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <span>{{ $contact['building'] }}</span>
                        {{--  隠しフィールドで実際のデータを送信  --}}
                        <input type="hidden" name="building" value="{{ $contact['building'] }}">
                    </td>
                </tr>

                {{--  問い合わせ種類  --}}
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        <span>{{ $category->content }}</span>
                        {{--  隠しフィールドで実際のデータを送信  --}}
                        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                    </td>
                </tr>

                {{--  問い合わせ内容  --}}
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        <span>{{ $contact['detail'] }}</span>
                        {{--  隠しフィールドで実際のデータを送信  --}}
                        <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
                    </td>
                </tr>
            </table>
        </div>

        {{--  ボタン  --}}
        <div class="form__button">
            {{--  送信  --}}
            <button class="form__button-submit" type="submit">送信</button>
            {{--  修正  --}}
            <button class="form__button-edit" type="button" onclick="event.preventDefault(); history.back();">修正</button>
        </div>
    </form>
</div>
@endsection