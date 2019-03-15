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
    return view('auth.login');
});

Route::resource('students', 'StudentsController');

Route::group(['middleware' => 'auth'], function(){
  Route::get('hello', function(){
    return 'hello';
  });
  Route::get('world', function(){
    return 'world';
  });

});

Auth::routes();

Route::get('/home', 'HomeController@index');
