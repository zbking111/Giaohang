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
Route::group(['prefix' => '', 'namespace' => 'Frontend', 'middleware' => 'web'], function() {

    Route::get('',  'HomeController@index')->name('home.index');
    Route::get('sign-up',  'HomeController@signup')->name('home.signup');
    Route::post('sign-up',  'HomeController@signupPost')->name('home.signup.post');

    Route::get('service',  'HomeController@service')->name('home.service');
    Route::get('introduction',  'HomeController@introduction')->name('home.introduction');
    Route::get('faq',  'HomeController@faq')->name('home.faq');
    Route::get('contact',  'HomeController@contact')->name('home.contact');
    Route::post('contact',  'HomeController@postContact')->name('home.contact.post');

    Route::get('map',  function () {
        return view('Backend.Contents.map');
    });

});

Route::post('/search','Backend\UserController@search')->name('user.search');

Route::group(['prefix' => 'admin', 'namespace' => 'Auth', 'middleware' => 'web'], function() {
    Route::get('login',  'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::get('register', 'LoginController@register')->name('register');
});

Route::group(['prefix' => 'admin/users'], function() {
    Route::get('user-permission/{id}', '\DangKien\RolePer\Controllers\UserRoleController@index')->name('user-permission.index');
    Route::post('user-permission/{id}', '\DangKien\RolePer\Controllers\UserRoleController@store')->name('user-permission.store');
    Route::get('role-permission/{id}', '\DangKien\RolePer\Controllers\RolePermissionController@index')->name('roles-permission.index');
    Route::post('role-permission/{id}', '\DangKien\RolePer\Controllers\RolePermissionController@store')->name('roles-permission.store');
});

Route::resource('admin/roles', '\DangKien\RolePer\Controllers\RoleController');
Route::group(['prefix' => '', 'middleware' => 'role:superadmin'], function() {
    Route::resource('admin/permissions', '\DangKien\RolePer\Controllers\PermissionController');
    Route::resource('admin/permissions-group', '\DangKien\RolePer\Controllers\PermissionGroupController');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function() {
    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
    

    Route::get('users/profile', 'UserController@show')->name('users.profile');
    Route::post('users/profile', 'UserController@updateSeft')->name('users.updateProfile');

    Route::get('users/change-password', 'UserController@change')->name('users.change');
    Route::post('users/change-password', 'UserController@changePassword')->name('users.changePassword');

    Route::resource('users', 'UserController');

    Route::get('/', 'HomeController@index')->name('dashboard.index');

    Route::resource('languages', 'LanguagesController', ['except'=>['destroy']]);

    Route::resource('categories', 'CategoryController', ['except'=>['destroy']]);

    Route::resource('customers', 'CustomerController', ['except'=>['destroy']]);

    Route::get('settings/contact', 'SettingController@contact')->name('settings.contact');
    Route::get('settings/seo-default', 'SettingController@seoDefault')->name('settings.seo_default');

    Route::get('orders/{id}/pick-shipper', 'OrderController@pickShipper')->name('orders.pick');
    Route::post('orders/{id}/pick-shipper', 'OrderController@pickShipperPost')->name('orders.pick.post');

    Route::resource('units', 'UnitController', ['except'=>['destroy']]);

    Route::resource('orders', 'OrderController', ['except'=>['destroy']]);
    Route::resource('customers', 'CustomerController', ['except'=>['destroy']]);

    Route::get('contacts', 'ContactController@index')->name('contacts.index');

});

Route::group(['prefix' => 'rest/admin', 'namespace' => 'Backend', 'middleware'=>'auth'], function() {
    Route::get('users', 'UserController@getList');
    Route::delete('users/{id}', 'UserController@destroy');

    Route::get('customers', 'CustomerController@getList');
    Route::delete('customers/{id}', 'CustomerController@destroy');
    Route::get('customers/status/{id}', 'CustomerController@status');

    Route::get('languages', 'LanguagesController@list');
    Route::delete('languages/{id}', 'LanguagesController@destroy');

    Route::get('categories', 'CategoryController@list');
    Route::delete('categories/{id}', 'CategoryController@destroy');

    Route::get('setting', 'SettingController@record');
    Route::post('add-setting', 'SettingController@saveSetting');

    Route::get('units', 'UnitController@getList');
    Route::delete('units/{id}', 'UnitController@destroy');
    Route::get('units/status/{id}', 'UnitController@status');

    Route::get('orders', 'OrderController@getList');
    Route::delete('orders/{id}', 'OrderController@destroy');
    Route::get('orders/status/{id}', 'OrderController@status');

    Route::get('contact', 'ContactController@list');
});