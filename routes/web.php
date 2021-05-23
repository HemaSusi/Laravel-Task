<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/adminlogin', 'AdminsController@adminlogin')->name('adminlogin');
Route::post('admin/check', 'AdminsController@check')->name('admin.check');
Route::post('/api/adminlogin', 'ApiController@adminlogin');
Route::get('/api/studentsList', 'ApiController@studentsList');


Route::get('/students/add', 'StudentsController@add')->name('students.add');
Route::get('/students/index', 'StudentsController@index')->name('students.index');
Route::get('/students/edit/', 'StudentsController@edit')->name('students.edit');
Route::get('/students/delete', 'StudentsController@delete')->name('students.delete');


