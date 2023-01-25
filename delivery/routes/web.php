<?php

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

Route::get('/basket/{order_id?}','App\Http\Controllers\BasketController@basket')->name('basket'); // набросок корзины

