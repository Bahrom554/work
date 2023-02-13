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



Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index')->name('home');
Route::resource('/group','GroupController');
Route::put('user/{user}/remove_from_group','GroupController@removeFromGroup')->name('remove_from_group');
Route::resource('user','UserController');
Route::resource('building','BuildingController');
