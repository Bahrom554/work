<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a team which
| contains the "web" middleware team. Now create something great!
|
*/



Auth::routes(['register' => false]);
Route::group(['middleware'=>['auth','role:'.User::ROLE_ADMIN.'|'.User::ROLE_MANAGER.'|'.User::ROLE_USER]],function() {
Route::get('/', 'HomeController@index')->name('home');
Route::resource('user','UserController');
Route::resource('team','TeamController');
Route::resource('building','BuildingController');
Route::resource('apartment','ApartmentController');
Route::resource('part','PartController');
Route::post('/pivot','PartController@createPivot')->name('pivot');
Route::get('profile/edit','ProfileController@edit')->name('profile.edit');
Route::put('profile/update','ProfileController@update')->name('profile.update');
Route::put('user/{user}/remove_from_team','TeamController@removeFromTeam')->name('remove_from_team');
Route::get('customer/{customer}','CustomerController@show')->name('customer.show');
Route::get('buildings/{building}/report/', 'BuildingController@report')->name('export.xlsx');

});