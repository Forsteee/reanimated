<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','App\Http\Controllers\HomeController@index')->name('index'); // каталог (главная страница)

Route::get('/categories/{category?}', 'App\Http\Controllers\HomeController@categories') -> name('categories'); // страница всех катгорий 

Route::get('/products/{product_id}','App\Http\Controllers\ProductController@product_page')->name('product_page'); // страничка продукта

Route::get('/basket','App\Http\Controllers\BasketController@basket')->name('basket'); // набросок корзины

Route::post('basket/add/{product_id}', 'App\Http\Controllers\BasketController@basketAdd')->name('basket-add'); // добавление товара в заказ

Route::post('basket/delete/{product_id}', 'App\Http\Controllers\BasketController@deleteProduct')->name('basket-delete-product'); // добавление товара в заказ

Route::get('/basket/confirm','App\Http\Controllers\BasketController@basketConfirmForm')->name('basket-confirm-form');// открыть страничку оформления заказа

Route::post('/basket/confirm', 'App\Http\Controllers\BasketController@orderConfirm')->name('order-confirm');// создать заказ

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
