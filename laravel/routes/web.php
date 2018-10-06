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

//客户
Route::any('/userList','UserController@userList');//客户 --列表
Route::any('/userAdd','UserController@userAdd');//客户 --添加
Route::any('/userUpdate','UserController@userUpdate');//客户 --修改
Route::get('/userType', function () {  //客户 --类型添加
    return view('User.userType');
});
Route::get('/userSource', function () {  //客户 --来源添加
    return view('User.userSource');
});
Route::any('/userTypeDo','UserController@userTypeDo');//客户执行 --类型添加
Route::any('/userSourceDo','UserController@userSourceDo');//客户执行 --来源添加
Route::any('/userAddDo','UserController@userAddDo');//客户执行 --客户添加
Route::any('/userUpdateDo','UserController@userUpdateDo'); //客户执行 --客户 更新
Route::any('/userDel','UserController@userDel'); //客户执行 -- 客户假删除

//售后
Route::any('/aftersaleList','AftersaleController@aftersaleList');//售后 --列表
Route::any('/aftersaleAdd','AftersaleController@aftersaleAdd');//售后 --添加
Route::any('/dispose','AftersaleController@dispose');//售后 --处理
Route::any('/aftersaleUpdate','AftersaleController@aftersaleUpdate');//售后 --修改视图
Route::get('/aftersaleClassify', function () {  //售后 --反馈分类 添加
    return view('Aftersale.aftersaleClassify');
});
Route::any('/aftersaleClassifyDo','AftersaleController@aftersaleClassifyDo');//售后执行 --反馈分类添加
Route::any('/aftersaleAddDo','AftersaleController@aftersaleAddDo');//售后执行 --售后添加
Route::any('/disposeDo','AftersaleController@disposeDo');//售后执行 --处理修改
Route::any('/aftersaleUpdateDo','AftersaleController@aftersaleUpdateDo');//售后执行 --修改
Route::any('/aftersaleDel','AftersaleController@aftersaleDel'); //客户执行 -- 客户假删除












Route::any('/comment','UserController@comment');//考试  -- 评论


