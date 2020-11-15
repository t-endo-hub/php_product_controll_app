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

Route::get('/product_item/create', 'ProductItemController@create')->name('product_item.create');

Route::post('/product_item/store', 'ProductItemController@store')->name('product_item.store');

Route::get('/product_item/{id}', 'ProductItemController@edit')->name('product_item.edit');

Route::post('/product_item/update', 'ProductItemController@update')->name('product_item.update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
