<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use APP\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products/index', [ProductsController::class, 'index'])->name('products.index');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home',function(){
    return redirect()->route('products.index');
})->name('home');


Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
Route::post('/products', [ProductsController::class, 'store'])->name('products.store');

Route::get('/users/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::get('/mypage', [App\Http\Controllers\UserController::class, 'mypage'])->name('mypage');

Route::get('/products/detail/{item}', [ProductsController::class, 'detail'])->name('products.detail');
Route::get('/products/edit/{item}', [ProductsController::class, 'edit'])->name('products.edit');
Route::put('/products/update/{item}', [ProductsController::class, 'update'])->name('products.update');
// 削除処理用のルートを追加します（Route::delete を使います）
Route::delete('/products/{item}', [ProductsController::class, 'destroy'])->name('products.destroy');
