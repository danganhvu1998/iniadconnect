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

Route::get('/user/view/{userID}', 'UsersController@userViewingSite');

// Subject Controller
Route::get('/subject/view', "SubjectsController@subjectSchoolViewingSite");

Route::get('/project/view', "SubjectsController@subjectProjectViewingSite");

Route::get('/subject/add/{subjectType}', "SubjectsController@subjectAddingSite");

Route::post('/subject/add', "SubjectsController@subjectAdding");

Route::get('/subject/edit/{subjectID}', "SubjectsController@subjectEdittingSite");

Route::post('/subject/edit/info', "SubjectsController@subjectEdittingInfo");

Route::post('/subject/edit/image', "SubjectsController@subjectEdittingImage");

Route::post('/subject/edit/cover_image', "SubjectsController@subjectEdittingCoverImage");

Route::get('/subject/visit/{subjectID}', "SubjectsController@subjectVisitingSite");

// Post Controller
Route::post('/post/add', "PostsController@postAdding");

Route::get('/post/edit/{postID}', "PostsController@postEditingSite");

Route::post('/post/edit', "PostsController@postEditing");

Route::get('/post/delete/{postID}', "PostsController@postDeletingSite");

Route::get('/post/view/{postID}', "PostsController@postViewingSite");

// Comment Controller
Route::post('/comment/add', "CommentsController@commentAdding");

#Route::get('/comment/edit/{commentID}', "CommentsController@commentEditingSite");

#Route::post('/comment/edit', "CommentsController@commentEditing");

Route::get('/comment/delete/{commentID}', "CommentsController@commentDeletingSite");

#Route::get('comment/view/{commentID}', "CommentsController@commentViewingSite");


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


