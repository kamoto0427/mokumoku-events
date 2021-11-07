<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CategoryController; // 追加

// もくもく会一覧画面
Route::get('/', [EventController::class, 'index'])
    ->name('event.index');

// カテゴリー一覧画面
Route::get('/category/index', [CategoryController::class, 'index'])
    ->name('category.index');