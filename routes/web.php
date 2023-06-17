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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/list/{id}', '\App\Http\Controllers\ToDo\ToDoController@show')->name('listSingle');
Route::get('/deleteImage/{id}', '\App\Http\Controllers\ToDo\ToDoController@deleteImage')->name('deleteImage');
Route::patch('/update/{id}', '\App\Http\Controllers\ToDo\ToDoController@update')->name('list.update');
Route::delete('/delete/{id}', '\App\Http\Controllers\ToDo\ToDoController@delete')->name('list.delete');

Route::group(['prefix' => 'filter'], function (){
    Route::get('/search', '\App\Http\Controllers\ToDo\FilterToDoController@search')->name('list.search');
    Route::get('/home', '\App\Http\Controllers\ToDo\FilterToDoController@filter')->name('list.filter');
});
