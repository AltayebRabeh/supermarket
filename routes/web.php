<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::group(['middleware' => 'auth'], function() {
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/admin', 'DashboardController@index')->name('dashboard');

    Route::get('/categories', 'CategoryController@index')->name('categories');
    Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
    Route::post('/categories/store', 'CategoryController@store')->name('categories.store');
    Route::get('/categories/{id}/edit', 'CategoryController@edit')->name('categories.edit');
    Route::post('/categories/{id}/update', 'CategoryController@update')->name('categories.update');
    Route::post('/categories/{id}/destroy', 'CategoryController@destroy')->name('categories.destroy');


    Route::get('/products', 'ProductController@index')->name('products');
    Route::get('/products/create', 'ProductController@create')->name('products.create');
    Route::post('/products/store', 'ProductController@store')->name('products.store');
    Route::get('/products/{id}/edit', 'ProductController@edit')->name('products.edit');
    Route::post('/products/{id}/update', 'ProductController@update')->name('products.update');
    Route::post('/products/{id}/destroy', 'ProductController@destroy')->name('products.destroy');

});

Route::get('/', 'HomeController@index')->name('index');
Route::get('/shop', 'HomeController@shop')->name('shop');
Route::get('/about-us', 'HomeController@index')->name('about');
Route::get('/contact-us', 'HomeController@index')->name('contact-us');
Route::get('/add-to-cart', 'HomeController@addToCart')->name('add-to-cart');
Route::get('/cart', 'HomeController@cart')->name('cart');
Route::get('/cart-count', 'HomeController@cartCount')->name('cart-count');
Route::get('/cart-delete/{id}', 'HomeController@cartDelete')->name('cart-delete');
Route::get('/cart-delete-back', 'HomeController@cartDeleteBack')->name('cart-delete-back');

Route::post('/pay', 'BillController@pay')->name('pay');