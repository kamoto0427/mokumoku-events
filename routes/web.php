<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CategoryController;

// もくもく会一覧画面
Route::get('/', [EventController::class, 'index'])
    ->name('event.index');
// もくもく会詳細画面
Route::get('/event/{id}', [EventController::class, 'show'])
    ->name('event.show');
// もくもく会登録画面
Route::get('/event/register', [EventController::class, 'register'])
    ->name('event.register');
// もくもく会登録処理
Route::post('/event/create', [EventController::class, 'create'])
    ->name('event.create');

// カテゴリー一覧画面
Route::get('/category/index', [CategoryController::class, 'index'])
    ->name('category.index');