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

Route::group(['prefix' => 'sales'], function () {
    Route::get('/', "AdminController@sales")->name('sales');
    Route::get('digital-product', "AdminController@digitalProductSales")->name('sales.digitalProduct');
    Route::get('{id}', "SalesController@detail")->name('sales.detail');
});

Route::group(['prefix' => 'user'], function () {
    Route::get('seller', "AdminController@seller")->name('user.seller');
    Route::get('seller/{id}', "AdminController@sellerDetail")->name('user.seller.detail');
    Route::get('customer', "AdminController@customer")->name('user.customer');
});
