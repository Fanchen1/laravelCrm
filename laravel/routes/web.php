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

//Route::get('/', function () {
//    return view('login');
//});
Route::any('/','LoginController@login');
Route::any('/check','LoginController@checkLogin');
Route::any('/index','IndexController@index');
Route::any('/welcome','IndexController@welcome');
Route::any('/quit','IndexController@quit');
Route::any('/order','OrderController@orderAdd');
Route::any('/order_no','OrderController@order_no');
Route::any('/order_add','OrderController@order_add');
Route::any('/adminSession','OrderController@adminSession');
Route::any('/order_list','OrderController@order_list');
Route::any('/weather','IndexController@weather');
