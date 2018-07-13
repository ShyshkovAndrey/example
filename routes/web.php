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
Route::get('setlocale/{locale}', 'LocaleController@setLocale');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::get('/profile/{id}', 'ProfileController@index')->name('profile');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin'], ], function () {

    Route::get('/', 'AdminController@index')->name('dashboard');

    Route::resource('users', 'UserController');

    Route::resource('roles', 'RoleController');

    Route::resource('news', 'NewsController');


    Route::resource('languages', 'LanguageController');

    Route::get('invite', 'InviteController@create')->name('invite.create');

    Route::post('invite', 'InviteController@store')->name('invite.store');
});



