<?php

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


Route::get('/', 'ProductItemController@index')->name('product_item.index');

Route::resource('product_item', 'ProductItemController', ['except' => ['index', 'show']]);

Route::resource('charge', 'ChargeController', ['except' => ['show']]);

Route::get('charge_can_work/create/{id}', 'ChargeCanWorkController@create')->name('charge_can_work.create');

Route::resource('charge_can_work', 'ChargeCanWorkController', ['only' => ['store']]);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
