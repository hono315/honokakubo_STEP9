<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;

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
Route::patch('/users', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');

Route::get('/mypage', [App\Http\Controllers\UserController::class, 'mypage'])->name('mypage');

Route::get('/products/detail/{item}', [ProductsController::class, 'detail'])->name('products.detail');
Route::get('/products/edit/{item}', [ProductsController::class, 'edit'])->name('products.edit');
Route::put('/products/update/{item}', [ProductsController::class, 'update'])->name('products.update');
Route::delete('/products/{item}', [ProductsController::class, 'destroy'])->name('products.destroy');
Route::post('/products/{item}/like', [ProductsController::class, 'like'])->name('products.like');
Route::delete('/products/{item}/like', [ProductsController::class, 'unlike'])->name('products.unlike');

Route::get('/products/exhibit_detail/{item}', [ProductsController::class, 'exhibit_detail'])->name('products.exhibit_detail');


Route::get('/products/checkout/{item}',[ProductsController::class, 'checkout'])->name('products.checkout');
Route::post('/products/checkout/{item}', [ProductsController::class, 'processCheckout'])->name('products.checkout.process');

Route::get('/contact',[ContactController::class,'showForm'])->name('contact.index');
Route::post('/contact',[ContactController::class,'submitForm'])->name('contact.submit');