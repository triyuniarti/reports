<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
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
    return view('auth.login');
});
//Route::post('/login', 'Auth\AuthController@postLogin');

/*| middleware default "WEB" : memeriksa Session CSRF, kernel HTTP, dll*/
Route::group(['middleware' => 'web'], function(){
    /*| redirect ke halaman login |*/
    Route::auth();
});

/*| url ini hanya bisa diakses oleh user yang sudah login |*/
Route::group(['middleware' => ['web', 'auth']], function()
{
    Route::get('/home', function(){
       if(Auth::user()->admin == 1){
           /*| untuk user login : admin |*/
           $controller = new  AdminController();
           return $controller->index();
       } else{
           /*| untuk user login : user biasa |*/
           //return view('users.user_home');
           $controller = new UserController();
           return $controller->index();
       }
    });
});

/*| url /admin hanya bisa diakses oleh user yang sudah login sebagai admin |*/
Route::get('admin', ['middleware' => ['web', 'auth', 'admin'], function(){
    return view('admin/admin.admin_home');
}]);

Route::get('home/create', 'UserController@create');

Route::post('home/create', 'UserController@store');

Route::post('home/add-category', 'UserController@addCategory');

Route::get('home/preview/{id}', 'UserController@show');

Route::get('home/update/{id}', 'UserController@edit');

Route::post('home/update/{id}', 'UserController@update');

Route::get('home/delete/{id}', 'UserController@delete');

Route::get('home/password', 'UserController@password');

Route::post('home/password', 'UserController@change');

Route::get('home/reports', 'AdminController@listReport');

Route::get('home/users', 'AdminController@listUsers');

Route::get('home/create-user', 'AdminController@create');

Route::post('home/create-user', 'AdminController@createUser');

Route::get('home/deleteUser/{id}', 'AdminController@deleteUser');