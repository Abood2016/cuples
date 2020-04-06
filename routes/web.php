<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;





Auth::routes();

Route::post('language', 'LanguageController@setLanguage')->name('language');


//admin routes
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => ['auth:admin']], function () {
 
        //admin-panel-routes
        Route::get('/home', 'adminHomeController@index')->name('dashboard');
        Route::get('get-admins' , 'AdminController@getAdmins')->name('admins');
        Route::get('admins', 'AdminController@showAdmins')->name('show.admins');
        Route::get('logout', 'AdminLoginController@logout')->name('logout');
        Route::delete('admin-delete', 'AdminController@destroy')->name('delete.admin');
        Route::get('/admin/edit/{id}', 'AdminController@editAdmin')->name('edit.admin');
        Route::put('/admin/update/{id}', 'AdminController@UpdateAdmin')->name('admin.update');
        Route::post('/add', 'AdminController@store')->name('admin.store');

        Route::get('/profile/{id}', 'AdminController@index')->name('profile.index');
        Route::put('/profile/update/', 'AdminController@Updateprofile')->name('profile.update');

        //site-settings-routes
        Route::resource('settings', 'SettingController');
        Route::get('get-settings', 'SettingController@getSettings')->name('settings');
        Route::get('/setting/edit/{id}', 'SettingController@EditSetting')->name('edit.setting');
        Route::put('/setting/update/{id}', 'SettingController@update')->name('setting.update');

    });

    Route::get('login', 'AdminLoginController@loginForm');
    Route::post('login', 'AdminLoginController@login')->name('admin.login');
});

Route::get('/home', 'HomeController@index')->name('home');
