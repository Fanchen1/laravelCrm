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

Route::any('/','LoginController@login');
Route::any('/check','LoginController@checkLogin');
Route::any('/index','IndexController@index');
Route::any('/translate','IndexController@translate');
Route::any('/translateApi','IndexController@translateApi');
Route::any('/userList','IndexController@userList');
Route::any('/email','IndexController@email');
Route::any('/welcome','IndexController@welcome');
Route::any('/quit','IndexController@quit');
Route::any('/order','OrderController@orderAdd');
Route::any('/pactAdd','PactController@pactAdd');
Route::any('/orderList','PactController@orderList');
Route::any('/pactNo','PactController@pactNo');
Route::any('/pactFind','PactController@pactFind');
Route::any('/pactAddAll','PactController@pactAddAll');
Route::any('/pactList','PactController@pactList');
Route::any('/pact_add','PactController@pact_add');
Route::any('/pact_add_name','PactController@pact_add_name');
Route::any('/audit','PactController@audit');
Route::any('/pactDel','PactController@pactDel');
Route::any('/pact_update','PactController@pact_update');
Route::any('/pactUpdate','PactController@pactUpdate');
Route::any('/order_no','OrderController@order_no');
Route::any('/order_add','OrderController@order_add');
Route::any('/adminSession','OrderController@adminSession');
Route::any('/order_list','OrderController@order_list');
Route::any('/orderDel','OrderController@orderDel');
Route::any('/delAll','OrderController@delAll');
Route::any('/search','OrderController@search');
Route::any('/order_update','OrderController@order_update');
Route::any('/updateDo','OrderController@updateDo');
Route::any('/weather','IndexController@weather');
