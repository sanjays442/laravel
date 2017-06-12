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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/users', 'UsersController@index');

Route::get('/users/edit_user/{id?}', 'UsersController@edit_user');

Route::post('/users/update_user/{id?}', 'UsersController@update_user');

Route::get('/users/manage_images/{id?}', 'UsersController@manage_images');

Route::post('/users/add_image/{id?}', 'UsersController@add_image');

Route::get('/users/delete_image/{id?}/{image_id?}', 'UsersController@delete_image');
