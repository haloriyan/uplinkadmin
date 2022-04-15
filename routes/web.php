<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return bcrypt('inikatasandi');
    return redirect()->route('admin.loginPage');
});

Route::get('login', "AdminController@loginPage")->name('admin.loginPage');
Route::post('login', "AdminController@login")->name('admin.login');
Route::get('logout', "AdminController@logout")->name('admin.logout')->middleware('Admin');
Route::get('dashboard', "AdminController@dashboard")->name('admin.dashboard')->middleware('Admin');
Route::get('profile', "AdminController@profile")->name('admin.profile')->middleware('Admin');
Route::post('profile/update', "AdminController@updateProfile")->name('profile.update')->middleware('Admin');
Route::get('withdrawal', "AdminController@withdrawal")->name('admin.withdrawal')->middleware('Admin');
Route::get('settings', "AdminController@settings")->name('settings')->middleware('Admin');

Route::group(['prefix' => "settings"], function () {
    Route::get('category', "SettingController@category")->name('settings.category')->middleware('Admin');
    Route::post('category/save', "SettingController@saveCategory")->name('settings.category.save')->middleware('Admin');
    Route::get('email', "SettingController@email")->name('settings.email')->middleware('Admin');
    
    Route::group(['prefix' => 'faq'], function () {
        Route::get('/', "SettingController@faq")->name('settings.faq')->middleware('Admin');
        Route::post('store', "FaqController@store")->name('faq.store')->middleware('Admin');
        Route::post('update', "FaqController@update")->name('faq.update')->middleware('Admin');
        Route::get('{id}/delete', "FaqController@delete")->name('faq.delete')->middleware('Admin');
    });
});

Route::group(['prefix' => 'sales'], function () {
    Route::get('/', "AdminController@sales")->name('sales')->middleware('Admin');
    Route::get('{id}', "SalesController@detail")->name('sales.detail')->middleware('Admin');
});

Route::group(['prefix' => 'user'], function () {
    Route::get('seller', "AdminController@seller")->name('user.seller')->middleware('Admin');
    Route::get('seller/{id}', "AdminController@sellerDetail")->name('user.seller.detail')->middleware('Admin');
    Route::get('customer', "AdminController@customer")->name('user.customer')->middleware('Admin');
    Route::get('customer/{id}/delete', "CustomerController@delete")->name('user.customer.delete');
    
    Route::group(['prefix' => "admin"], function () {
        Route::get('/', "AdminController@admin")->name('user.admin')->middleware('Admin');
        Route::post('store', "AdminController@adminStore")->name('user.admin.store')->middleware('Admin');
        Route::post('update', "AdminController@adminUpdate")->name('user.admin.update')->middleware('Admin');
        Route::get('{id}/delete', "AdminController@adminDelete")->name('user.admin.delete')->middleware('Admin');
    });
});
