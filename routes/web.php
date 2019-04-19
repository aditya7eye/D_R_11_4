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
    //----------------------------- store -----------------------------//
    Route::get('store', 'StoreController@store')->name("store");
    Route::get('insert_store', 'StoreController@insert_store')->name("store");
    Route::get('check_store_username', 'StoreController@check_store_username');
    Route::get('edit_store/{id}', 'StoreController@edit_store');
    Route::get('update_store/{id}', 'StoreController@update_store');
    Route::get('del_store', 'StoreController@del_store');

    //----------------------------- Vendor -----------------------------//
    Route::get('vendor', 'VendorController@vendor')->name("vendor");
    Route::get('insert_vendor', 'VendorController@insert_vendor');
    Route::get('edit_vendor/{id}', 'VendorController@edit_vendor');
    Route::get('update_vendor/{id}', 'VendorController@update_vendor');
    Route::get('del_vendor', 'VendorController@del_vendor');
    //----------------------------- Vendor -----------------------------//
    Route::get('unit', 'UnitController@unit')->name("unit");
    Route::get('insert_unit', 'UnitController@insert_unit');
    Route::get('edit_unit/{id}', 'UnitController@edit_unit');
    Route::get('update_unit/{id}', 'UnitController@update_unit');
    Route::get('del_unit', 'UnitController@del_unit');
    //----------------------------- Brand -----------------------------//
    Route::get('brand', 'BrandController@brand')->name("brand");
    Route::get('insert_brand', 'BrandController@insert_brand');
    Route::get('edit_brand/{id}', 'BrandController@edit_brand');
    Route::get('update_brand/{id}', 'BrandController@update_brand');
    Route::get('del_brand', 'BrandController@del_brand');


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
// Route::get('s_logout', 'LoginController@s_logout');

Route::group(['middleware' => 'storesession'], function ()
{
    Route::get('store_dashboard', 'StoreMasterController@store_dashboard')->name("store_dashboard");
    
    ///////////products
    Route::get('products', 'ProductController@products')->name("products");
    Route::post('insert_products', 'ProductController@insert_products')->name("products");
    Route::get('findsuggetion', 'ProductController@findsuggetion');
    Route::get('getallrecord', 'ProductController@getallrecord');

    Route::get('purchase', 'ProductController@purchase')->name("purchase");
    Route::post('addpurchase', 'ProductController@addpurchase')->name("purchase");
    Route::get('addnewrow', 'ProductController@addnewrow');

    /////////////barcode

    Route::get('barcode', 'BarcodeController@barcode')->name("barcode");
    //----------------------------- Store / Staff-----------------------------//
    Route::get('staff', 'StaffController@staff')->name("staff");
    Route::get('insert_staff', 'StaffController@insert_staff')->name("store");
    Route::get('check_staff_username', 'StaffController@check_staff_username');
    Route::get('edit_staff/{id}', 'StaffController@edit_staff');
    Route::get('update_staff/{id}', 'StaffController@update_staff');
    Route::get('del_staff', 'StaffController@del_staff');
    Route::get('bar', 'StaffController@bar');

    Route::get('pos', 'StaffController@pos');
    Route::get('getproducts', 'StaffController@getproducts');
    Route::get('productdata', 'StaffController@productdata');
    Route::get('getBarcodeProducts', 'StaffController@getBarcodeProducts');
    Route::get('mobileCheck', 'StaffController@mobileCheck');

});
