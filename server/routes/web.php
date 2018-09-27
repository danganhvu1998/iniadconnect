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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// User Controller
Route::get('/user/setting/setting', 'UsersController@finishRegisterSite');

Route::post('/user/setting/name', 'UsersController@userSettingNameChange');

Route::post('/user/setting/password', 'UsersController@userSettingPasswordChange');

Route::post('/user/setting/image', 'UsersController@userSettingImageChange');

Route::post('/user/setting/card_image', 'UsersController@userSettingCardImageChange');

Route::get('/user/view', 'UsersController@userViewingSite');

//

//            \\
#              #
#              # 
#  ADMIN SITE  #
#              #
#              #
//            \\

// Admin User Controller
Route::get('/admin/user/view/{userType}', 'AdminUsersController@usersViewSite');

Route::get('/admin/user/reset_password/{userID}', 'AdminUsersController@resetUserPassword');
Route::get('/admin/user/confirm/{type}/{userID}', 'AdminUsersController@changeTypeUser');


