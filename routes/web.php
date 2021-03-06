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

Route::get("books/export/{type}", "BookController@export");
Route::Resource("books", "BookController", ['names' => [
    'index' => 'books',
    'store' => 'books.create',
]]);