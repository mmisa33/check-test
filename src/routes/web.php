<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 問い合わせ関連
Route::get('/', [ContactController::class, 'index']);    // 一覧ページ
Route::post('/confirm', [ContactController::class, 'confirm']);    // 確認ページ
Route::post('/thanks', [ContactController::class, 'store']);    // 送信完了ページ


// Fortifyのデフォルト設定からリダイレクト先の変更を加えるため作成
// ユーザー登録画面
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// ログイン画面
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

//管理画面
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/search', [AdminController::class, 'search']);
Route::get('/admin/export', [AdminController::class, 'export']);

// 認証ミドルウェアを`admin` プレフィックス全てに適用
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // 管理画面
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    // 検索
    Route::get('/search', [AdminController::class, 'search']);
    // エクスポート
    Route::get('/export', [AdminController::class, 'export']);
});

// ログアウト機能
Route::post('/logout', [AuthController::class, 'logout']);