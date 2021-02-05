<?php

use Illuminate\Support\Facades\Route;


//ajax
Route::get('/setting-website', 'App\Http\Controllers\User\HomeController@setting')->name('setting_website');

//user
Route::get('/', 'App\Http\Controllers\User\HomeController@index')->name('home');
Route::get('/san-pham', 'App\Http\Controllers\User\HomeController@products')->name('product');
Route::get('/dang-nhap', 'App\Http\Controllers\User\HomeController@login')->name('login');
Route::get('/chi-tiet-san-pham', 'App\Http\Controllers\User\HomeController@details')->name('details');

//admin
Route::get('/dashboardmain', ['after' => 'filter.auth', 'uses' => 'App\Http\Controllers\Admin\DashboardController@index'])->name('dashboard');
Route::get('/dashboard', 'App\Http\Controllers\Admin\DashboardController@index')->name('dashboard');
Route::get('/admin-login', 'App\Http\Controllers\Admin\DashboardController@login')->name('admin_login');

//setting
Route::group(['prefix' => '/admin-setting'], function () {
    Route::get('/', 'App\Http\Controllers\Admin\DashboardController@setting')->name('admin_setting');
    Route::post('/admin-save-setting', 'App\Http\Controllers\Admin\SystemController@store')->name('system_save');
});

//category
Route::group(['prefix' => '/admin-category'], function () {
    Route::get('/', 'App\Http\Controllers\Admin\CategoryController@index')->name('admin_category');
    Route::get('/create', 'App\Http\Controllers\Admin\CategoryController@create')->name('admin_category_create');
    Route::post('/store', 'App\Http\Controllers\Admin\CategoryController@store')->name('admin_category_store');

    Route::get('/edit/{id}', 'App\Http\Controllers\Admin\CategoryController@edit')->name('admin_category_edit');
    Route::post('/update/{id}', 'App\Http\Controllers\Admin\CategoryController@update')->name('admin_category_update');

    Route::get('/destroy/{id}', 'App\Http\Controllers\Admin\CategoryController@destroy')->name('admin_category_destroy');
});

//size
Route::group(['prefix' => '/admin-size'], function () {
    Route::get('/', 'App\Http\Controllers\Admin\SizeController@index')->name('admin_size');
    Route::get('/create', 'App\Http\Controllers\Admin\SizeController@create')->name('admin_size_create');
    Route::get('/edit/{id}', 'App\Http\Controllers\Admin\SizeController@edit')->name('admin_size_edit');
    Route::get('/destroy/{id}', 'App\Http\Controllers\Admin\SizeController@destroy')->name('admin_size_destroy');


    Route::post('/store', 'App\Http\Controllers\Admin\SizeController@store')->name('admin_size_store');
    Route::post('/update/{id}', 'App\Http\Controllers\Admin\SizeController@update')->name('admin_size_update');
});

//product
Route::group(['prefix' => '/admin-product'], function () {
    Route::get('/', 'App\Http\Controllers\Admin\ProductController@index')->name('admin_product');
    Route::get('/create', 'App\Http\Controllers\Admin\ProductController@create')->name('admin_product_create');
    Route::get('/edit/{id}', 'App\Http\Controllers\Admin\ProductController@edit')->name('admin_product_edit');
    // Route::get('/destroy/{id}', 'App\Http\Controllers\Admin\SizeController@destroy')->name('admin_product_destroy');

    Route::post('/store', 'App\Http\Controllers\Admin\ProductController@store')->name('admin_product_store');
    Route::post('/update/{id}', 'App\Http\Controllers\Admin\ProductController@update')->name('admin_product_update');
});