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

Route::get('/', function () {
    return view('welcome');
});

Route::post('ajax-all-books', 'BooksController@ajaxAllBooks')->name('book.books');
Route::resource('books', 'BooksController');

Route::post('ajax-all-authors', 'AuthorController@ajaxAllAuthors')->name('author.authors');
Route::resource('authors', 'AuthorController');
