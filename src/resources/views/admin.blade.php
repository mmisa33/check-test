@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin-contact__content">
    <!-- ページタイトル -->
    <div class="admin-contact__heading">
        <h2>Admin</h2>
    </div>

    <!-- 検索フォーム -->
    <div class="admin-contact__search">
        <form class="search-form" action="/admin/search" method="GET">
            @csrf
            <!-- キーワード（名前、メールアドレス） -->
            <div class="search-form__item">
                <input class="search-form__item--keyword" type="keyword" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ old('keyword') }}">
            </div>

            <!-- 性別 -->
            <div class="search-form__item">
                <div class="search-form__select-wrapper">
                    <select class="search-form__item--select" name="gender">
                        <option value="">性別</option>
                        <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全て</option>
                        <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                        <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                        <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                    </select>
                    <span class="search-form__select-arrow"></span>
                </div>
            </div>

            <!-- 問い合わせ種類 -->
            <div class="search-form__item">
                <div class="search-form__select-wrapper">
                    <select class="search-form__item--select" name="category_id">
                        <option value="">お問い合わせの種類</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category['content'] }}</option>
                        @endforeach
                    </select>
                    <span class="search-form__select-arrow"></span>
                </div>
            </div>

            <!-- 年月日 -->
            <div class="search-form__item">
                <div class="search-form__select-wrapper">
                    <input class="search-form__item--select search-form__item--date" type="date" name="date" value="年/月/日">
                    <span class="search-form__select-arrow"></span>
                </div>
            </div>

            <!-- 検索ボタン -->
            <div class="search-form__button">
                <button class="search-form__button--search" type="submit">検索</button>
            </div>

            <!-- リセットボタン -->
            <div class="search-form__button">
                <button class="search-form__button--reset" type="button" onclick="resetForm()">リセット</button>
            </div>
        </form>
    </div>

    <!-- 管理画面操作機能 -->
    <div class="admin-contact__actions">
        <!-- エクスポートボタン -->
        <div class="export-button">
            <a href="{{ route('contacts.export') }}" class="export-button__submit">エクスポート</a>
        </div>
        <!-- ページネーションリンク -->
        <div class="pagination">
            {{ $contacts->links() }}
        </div>
    </div>

    <!-- 問い合わせテーブル -->
    <div class="contact-list">
        <table class="contact-list__inner">
            <!-- ヘッダー -->
            <tr class="contact-list__row">
                <th class="contact-list__header">
                    <span class="admin-table__header-span">お名前</span>
                </th>
                <th class="contact-list__header">
                    <span class="admin-table__header-span">性別</span>
                </th>
                <th class="contact-list__header">
                    <span class="admin-table__header-span">メールアドレス</span>
                </th>
                <th class="contact-list__header">
                    <span class="admin-table__header-span">お問い合わせの種類</span>
                </th>
                <th class="contact-list__header">
                    <span class="contact-list__header-span"></span>
                </th>
            </tr>

            <!-- 問い合わせ一覧 -->
            @foreach($contacts as $contact)
            <tr class="contact-list__row">
                <td class="contact-list__data">{{ $contact->last_name }}&emsp;{{ $contact->first_name }}</td>
                <td class="contact-list__data">{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td>
                <td class="contact-list__data">{{ $contact->email }}</td>
                <td class="contact-list__data">{{ $contact->category->content }}</td>
                <td class="contact-list__data">
                    <!-- 詳細ボタン -->
                    <button class="contact-detail__button" type="button" wire:click="openModal()">詳細</button>
                    <!-- Livewireモーダルコンポーネント -->
                    @livewire('contact-modal')
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

<!-- 検索後にリセットボタンを押したら初期状態に戻す -->
<script>
    function resetForm() {
        document.querySelector('.search-form').reset();

        window.location.href = window.location.pathname;
    }
</script>

@endsection