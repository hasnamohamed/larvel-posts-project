<?php

use App\Http\Controllers\Postcontroller;
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

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
Route::get('/posts', 'Postcontroller@index')->name('posts.index');
Route::get('/posts/create','Postcontroller@create')->name('posts.create');
Route::post('/posts','Postcontroller@store')->name('posts.store');
Route::get('/posts/{id}','Postcontroller@show')->name('posts.show');
Route::get('/posts/{id}/edit','Postcontroller@edit')->name('posts.edit');
Route::Put('/posts/{id}','Postcontroller@update')->name('posts.update');//put to send data from the form after the editing
Route::delete('/posts/{id}','Postcontroller@destroy')->name('posts.destroy');//put to send data from the form after the editing


Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
