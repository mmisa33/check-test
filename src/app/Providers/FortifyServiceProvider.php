<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Http\Requests\LoginRequest;
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        // 新規ユーザー作成処理のカスタマイズ
        Fortify::createUsersUsing(CreateNewUser::class);

        // ログイン画面
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // 登録画面
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // ログイン試行回数の制限
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;
            return Limit::perMinute(10)->by($email . $request->ip());
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
    }
}
