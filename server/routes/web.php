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

// User Controller
Route::get('/user/setting/setting', 'UsersController@finishRegisterSite');

Route::post('/user/setting/name', 'UsersController@userSettingNameChange');

Route::post('/user/setting/password', 'UsersController@userSettingPasswordChange');

Route::post('/user/setting/image', 'UsersController@userSettingImageChange');

Route::get('/user/view', 'UsersController@userViewingSite');

//

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
