@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form__content">
    {{--  ページタイトル  --}}
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>

    {{--  問い合わせフォーム  --}}
    <form class="form" action="/confirm" method="post">
        @csrf
        {{--  名前入力  --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text form__input--name">
                    <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                    <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
                </div>
                {{--  エラーメッセージ  --}}
                <div class="form__error">
                    @error('last_name')
                    <span>{{ $message }}</span>
                    @enderror
                    @error('first_name')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        {{--  性別選択  --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--radio">
                    <label>
                        <input type="radio" name="gender" value="1" {{ old('gender', 1) == 1 ? 'checked' : '' }}> 男性
                    </label>
                    <label>
                        <input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}> 女性
                    </label>
                    <label>
                        <input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}> その他
                    </label>
                </div>
                {{--  エラーメッセージ  --}}
                <div class="form__error">
                    @error('gender')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        {{--  メールアドレス入力  --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                </div>
                {{--  エラーメッセージ  --}}
                <div class="form__error">
                    @error('email')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        {{--  電話番号入力  --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text form__input--tel">
                    {{--  090部分  --}}
                    <input type="tel" name="tel_area" placeholder="090" value="{{ old('tel_area') }}">
                    {{--  ハイフン  --}}
                    <span>-</span>

                    {{--  1234部分  --}}
                    <input type="tel" name="tel_number" placeholder="1234" value="{{ old('tel_number') }}">
                    {{--  ハイフン  --}}
                    <span>-</span>

                    {{--  5678部分  --}}
                    <input type="tel" name="tel_end" placeholder="5678" value="{{ old('tel_end') }}">
                </div>
                {{--  エラーメッセージ  --}}
                {{--  各電話番号フィールドのエラーを統一＆重複したエラーメッセージを表示しない処理  --}}
                <div class="form__error">
                    @php
                        $messages = [];
                    @endphp
                    @foreach (['tel_area', 'tel_number', 'tel_end'] as $field)
                        @foreach ($errors->get($field) as $error)
                            @if (!isset($messages[$error]))
                                <span>{{ $error }}</span>
                                @php $messages[$error] = true; @endphp
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>

        {{--  住所入力  --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                </div>
                {{--  エラーメッセージ  --}}
                <div class="form__error">
                    @error('address')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        {{--  建物名入力  --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
                </div>
                {{--  エラーメッセージ  --}}
                <div class="form__error">
                    @error('building')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        {{--  問い合わせ種類選択  --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__select-wrapper">
                    <select class="form__select" name="category_id">
                        <option value="">選択してください</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category['content'] }}</option>
                        @endforeach
                    </select>
                    <span class="form__select-arrow"></span>
                </div>
                {{--  エラーメッセージ  --}}
                <div class="form__error">
                    @error('category_id')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        {{--  問い合わせ内容入力  --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                </div>
                {{--  エラーメッセージ  --}}
                <div class="form__error">
                    @error('detail')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        {{--  送信ボタン  --}}
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection