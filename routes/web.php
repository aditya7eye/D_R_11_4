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
    Route::get('edit_store/{id}', 'StoreController@edit_store')->name("store");
    Route::get('update_store/{id}', 'StoreController@update_store');
    Route::get('del_store', 'StoreController@del_store');

    ///////// category
    Route::get('category', 'CategoryController@category')->name("category");
    Route::get('insert_category', 'CategoryController@insert_category')->name("category");
    Route::get('edit_category/{id}', 'CategoryController@edit_category')->name("category");
    Route::get('update_category/{id}', 'CategoryController@update_category');
    Route::get('del_cate', 'CategoryController@del_cate');

    ///////// Sub-category

    Route::get('sub_category', 'CategoryController@sub_category')->name("sub_category");
    Route::get('insert_subcategory', 'CategoryController@insert_subcategory')->name("sub_category");
    Route::get('edit_sub_category/{id}', 'CategoryController@edit_sub_category')->name("sub_category");
    Route::get('update_sub_category/{id}', 'CategoryController@update_sub_category')->name("sub_category");

});

///////////store
Route::get('/login_store', 'LoginController@login_store');
Route::POST('check_store', 'LoginController@check_store');
Route::get('s_logout', 'LoginController@s_logout');

Route::group(['middleware' => 'storesession'], function () {
    Route::get('store_dashboard', 'StoreMasterController@store_dashboard')->name("store_dashboard");
});
