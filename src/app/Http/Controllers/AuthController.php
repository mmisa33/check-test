<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

// Fortifyのデフォルト設定からリダイレクト先の変更を加えるため作成
class AuthController extends Controller
{
    // 登録画面の表示
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // ユーザー登録処理
    public function register(Request $request)
    {
        // バリデーション：フォームリクエスト（validation.php）に詳細記載
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);

        // ユーザー作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // ユーザー登録イベント
        event(new Registered($user)); // FortifyのRegisteredイベントを使用

        // 自動ログイン
        Auth::login($user); // Authファサードのloginメソッドを使用

        // ログイン画面へリダイレクト
        return redirect()->route('login');
    }

    // ログインページ表示
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ログイン処理
    public function login(Request $request)
    {
        // バリデーション：フォームリクエスト（validation.php）に詳細記載
        $this->validate($request, [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required'],
        ]);

        // ログイン試行
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // 成功した場合、ダッシュボードにリダイレクト
            return redirect()->intended('admin');
        }

        // 失敗した場合、再ログイン画面を表示
        return back()->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout(); // ログアウト

        // セッションをクリアしてログインページにリダイレクト
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); // loginページへリダイレクト
    }
}
