<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @yield('css')
</head>

<body class="{{ Route::currentRouteName() }}">
    <!-- 共通ヘッダー -->
    <header class="header">
        <div class="header__inner">
            <!-- サイトタイトル -->
            <div class="header__logo">
                <a class="header__logo-link" href="/">FashionablyLate</a>
            </div>

            <!-- ナビボタン  -->
            <div class="header__nav">
                <!-- ログインページには登録ボタンを表示する -->
                @if(Route::currentRouteName() == 'login')
                <a class="header__nav-button" href="/register">register</a>
                <!-- 登録ページにはログインボタンを表示する -->
                @elseif(Route::currentRouteName() == 'register')
                <a class="header__nav-button" href="/login">login</a>
                <!-- 管理画面にはログアウトボタンを表示する -->
                @elseif(Route::currentRouteName() == 'admin')
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="header__nav-button">logout</button>
                </form>
                @endif
            </div>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main>
        @yield('content')
    </main>
</body>

</html>