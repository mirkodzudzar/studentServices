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

// Auth::routes();


Route::group(['middleware' => ['web']], function() {

// Login Routes...
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
    Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// Registration Routes...
    // Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
    // Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@register']);

// Password Reset Routes...
    Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
    Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);
});



Route::resource('students', 'StudentsController');

Route::get('subjects/create', 'SubjectsController@create');
Route::post('subjects', 'SubjectsController@store');
Route::get('subjects/{subject}', 'SubjectsController@show');
Route::get('subjects/{subject}/edit', 'SubjectsController@edit');
Route::put('subjects/{subject}', 'SubjectsController@update');
Route::delete('subjects/{subject}', 'SubjectsController@destroy');

Route::get('exams/{student}', 'ExamsController@show');
Route::put('exams/{student}', 'ExamsController@reportExam');
Route::post('exams/{student}', 'ExamsController@storePoints');

Route::get('departments/create', 'DepartmentsController@create');
Route::post('departments', 'DepartmentsController@store');
Route::get('departments/{department}', 'DepartmentsController@show');
Route::get('departments/{department}/edit', 'DepartmentsController@edit');
Route::put('departments/{department}', 'DepartmentsController@update');
Route::delete('departments/{department}', 'DepartmentsController@destroy');
