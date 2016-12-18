<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/admin', function()
{
    return view('admin.index'); // admin:folder, index:file ... resources : admin/index.blade.php
});

Route::group(['middleware'=>'admin'], function()        // group-ot hozunk létre a middleware számára...
{                                                        // a Kernel.php-ban is meg kellett adni a class-t előtte !!!{
    Route::resource('admin/users','AdminUsersController');
});




