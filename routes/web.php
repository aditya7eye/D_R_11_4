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

////////----Dashboard

Route::get('/', 'LoginController@login');
Route::POST('check_user', 'LoginController@check_user');
Route::get('logout', 'LoginController@logout');

Route::group(['middleware' => 'usersession'], function () {
    Route::get('master_dashboard', 'MasterController@master_dashboard')->name("master_dashboard");
    //////// store
    Route::get('store', 'StoreController@store')->name("store");
    Route::get('insert_store', 'StoreController@insert_store')->name("store");
    Route::get('check_store_username', 'StoreController@check_store_username');
    Route::get('edit_store/{id}', 'StoreController@edit_store');
    Route::get('update_store/{id}', 'StoreController@update_store');
    Route::get('del_store', 'StoreController@del_store');
});
