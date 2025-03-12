<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

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

// 認証ミドルウェアを`admin`プレフィックス全てに適用
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');    // 管理画面
    Route::get('/search', [AdminController::class, 'search']);    // 検索
    Route::get('/export', [AdminController::class, 'export']);    // エクスポート
});

// ログアウト処理
Route::post('/logout', [AuthController::class, 'logout']);

