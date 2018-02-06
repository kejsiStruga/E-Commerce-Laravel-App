<?php

use App\Image;
use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\Category;
use App\Album;

Route::auth();

/******************************    ADMIN   ******************************************/
Route::group(['middleware' => ['AdminMiddleware', 'auth']], function()
{	
	
		Route::get('/admin', 'HomeController@index');
		
		Route::resource('user', 'UserController');
		Route::resource('role','RoleController');
    Route::resource('category', 'CategoryController');
    Route::resource('album', 'AlbumController');

    Route::put('/remove/{album}', 'CategoryController@removeAlbum');
    Route::put('/removeimg/{image}', 'AlbumController@removeImage');

    Route::get('roles/{role}', 'RoleController@show');
    Route::get('roles', 'RoleController@index');
		Route::get('user/create', 'UserController@create');
		Route::post('user/store', 'UserController@store');

});

/*******************************   AUTH USER  *********************************************/
Route::group(['middleware' => 'auth'], function () {

Route::post('reset_password', 'UserController@reset_submit');
Route::get('/category','CategoryController@index');
Route::get('/category/{category}','CategoryController@show');

Route::get('/album','AlbumController@index');
Route::get('/album/{album}','AlbumController@show');

Route::get('/', 'CategoryController@index');
Route::get('/reset_password', 'UserController@reset_password');

Route::resource('image', 'ImageController');

Route::get('/home', 'CategoryController@index');

Route::post('user', 'UserController@store');
});
