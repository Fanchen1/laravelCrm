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
Route::any('/userDelAll','UserController@userDelAll'); //客户执行 -- 客户批量假删除
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
Route::any('/aftersaleDel','AftersaleController@aftersaleDel'); //售后执行 -- 售后假删除
Route::any('/aftersaleDelAll','AftersaleController@aftersaleDelAll'); //售后执行 -- 售后批量假删除

//RBAC
    //权限分类
    Route::any('/PowerAdd','PowerController@PowerAdd');//权限添加
    Route::any('/PowerAddDo','PowerController@PowerAddDo');//权限执行 -- 添加
    Route::any('/PowerList','PowerController@PowerList');//权限列表
    //角色
    Route::any('/RoleList','RoleController@RoleList');//角色列表
    Route::any('/RoleAdd','RoleController@RoleAdd');//权限添加



// ----------跟单
Route::any('tailorderAdd', 'admin\TailorderController@tailorderAdd');
Route::any('tailorderAddDo', 'admin\TailorderController@tailorderAddDo');
Route::any('tailorderList', 'admin\TailorderController@tailorderList');
Route::any('tailorderDel', 'admin\TailorderController@tailorderDel');
Route::any('tailorderDelAll', 'admin\TailorderController@tailorderDelAll');
Route::any('tailorderUpd', 'admin\TailorderController@tailorderUpd');
Route::any('tailorderUpdDo', 'admin\TailorderController@tailorderUpdDo');

//跟单类型添加
Route::any('tailorderTypeAdd', 'admin\TailorderController@tailorderTypeAdd');
Route::any('tailorderTypeAddDo', 'admin\TailorderController@tailorderTypeAddDo');
//跟单进度添加
Route::any('tailorderPlanAdd', 'admin\TailorderController@tailorderPlanAdd');
Route::any('tailorderPlanAddDo', 'admin\TailorderController@tailorderPlanAddDo');

/**
 * ------------------------费用管理
 */
//展示
Route::any('costList', 'admin\CostController@costList');
//删除
Route::any('costDel', 'admin\CostController@costDel');
Route::any('costDelAll', 'admin\CostController@costDelAll');

//添加
Route::any('costAdd', 'admin\CostController@costAdd');
Route::any('costAddDo', 'admin\CostController@costAddDo');

//费用类型添加
Route::any('costTypeAdd', 'admin\CostController@costTypeAdd');
Route::any('costTypeAddDo', 'admin\CostController@costTypeAddDo');

//修改
Route::any('costUpd', 'admin\CostController@costUpd');
Route::any('costUpdDo', 'admin\CostController@costUpdDo');


// =---------下拉框
Route::any('/Type','FrameController@Type');//客户类型 列表
Route::any('/TypeDo','FrameController@TypeDo');//客户类型 删除 --

Route::any('/Source','FrameController@Source');//客户来源 列表
Route::any('/SourceDo','FrameController@SourceDo');//客户来源 删除 --

Route::any('/Type_data','FrameController@Type_data');//跟单类型 列表
Route::any('/Type_dataDo','FrameController@Type_dataDo');//跟单类型 删除 --

Route::any('/Plan_data','FrameController@Plan_data');//跟单进度 列表
Route::any('/Plan_dataDo','FrameController@Plan_dataDo');//跟单进度 删除 --

Route::any('/Costtype_data','FrameController@Costtype_data');//费用类型 列表
Route::any('/Costtype_dataDo','FrameController@Costtype_dataDo');//费用类型 删除 --

Route::any('/Classify','FrameController@Classify');//反顾分类
Route::any('/ClassifyDo','FrameController@ClassifyDo');//反顾分类 删除 --






















Route::any('/comment','UserController@comment');//考试  -- 评论





