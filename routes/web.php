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

Route::get('/', 'App\Http\Controllers\welcomeController@index');

Auth::routes();
Route::group(['middleware' => 'auth'], function() {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/tags', 'App\Http\Controllers\tagsController');
Route::resource('/categories', 'App\Http\Controllers\categoriesController');
Route::resource('/posts', 'App\Http\Controllers\postController');
Route::get('/trashed-posts', 'App\Http\Controllers\postController@trashed')->name('trashed.index');
Route::get('/trashed-posts/{id}', 'App\Http\Controllers\postController@restore')->name('trashed.restore');
});

Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/dashboard', 'App\Http\Controllers\dashboardController@index')->name('dashboard');
    Route::get('/users', 'App\Http\Controllers\userController@index')->name('users.index');
    Route::post('/users/{user}/make-admin', 'App\Http\Controllers\userController@makeAdmin')->name('users.make-admin');
    Route::post('/users/{user}/make-writer', 'App\Http\Controllers\userController@makeWriter')->name('users.make-writer');
});
Route::middleware(['auth'])->group(function() {
    Route::get('/users/{user}/profile', 'App\Http\Controllers\userController@edit')->name('users.edit');
    Route::post('/users/{user}/profile', 'App\Http\Controllers\userController@update')->name('users.update');
});