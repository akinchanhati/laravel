<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/test', function () {
    return view('test');
});

Route::get('/test1', 'HomeController@index')->name('home');

// Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

// Course section
Route::get('/course_list', 'CourseController@list')->name('course_list');
Route::get('/course_add', 'CourseController@add_course_view');
Route::post('/course_add', 'CourseController@add_course')->name('course_add');
Route::get('/course_edit/{id}', 'CourseController@edit_course_view');
Route::post('/course_edit', 'CourseController@edit_course')->name('course_update');
Route::get('/course_delete/{id}', 'CourseController@delete_course');

// User Profile
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::post('/update_profile', 'HomeController@update_profile')->name('update_profile');

// Search
Route::get('/search', 'HomeController@search')->name('search');
