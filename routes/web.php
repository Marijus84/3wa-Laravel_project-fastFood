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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/restaurants/search', 'RestaurantController@search')->name('restaurant.search');
Route::get('/restaurants/view', 'RestaurantController@view')->name('restaurants.view');
Route::resource('restaurants', 'RestaurantController');
Route::resource('lives', 'LiveController');
Route::resource('reviews', 'ReviewController');
Route::resource('users', 'UserController');
Route::post('reviews/load', 'ReviewController@load')->name('reviews.load');
Route::post('restaurants/map', 'RestaurantController@map')->name('restaurant.map');
