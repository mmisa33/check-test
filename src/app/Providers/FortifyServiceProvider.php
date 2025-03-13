<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Hash;

use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Actions\Fortify\CreateNewUser;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ユーザー登録処理のカスタマイズ
        Fortify::createUsersUsing(CreateNewUser::class);

        // ログイン画面の表示
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // 登録画面の表示
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // Fortifyの認証処理
        Fortify::authenticateUsing(function (FortifyLoginRequest $request) {
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            return null;
        });

        // ログイン画面にカスタムバリデーションを適用
        $this->app->singleton(FortifyLoginRequest::class, function ($app) {
            return $app->make(LoginRequest::class);
        });

        // ユーザー登録後のリダイレクト先の変更
        $this->app->singleton(RegisterResponse::class, function () {
            return new class implements RegisterResponse {
                public function toResponse($request)
                {
                    auth()->logout();
                    session()->invalidate();
                    session()->regenerateToken();

                    return redirect('/login');
                }
            };
        });

        // ログイン試行回数の制限を設定
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;
            return Limit::perMinute(10)->by($email . $request->ip());
        });
    }
}
