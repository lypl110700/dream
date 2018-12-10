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
    return redirect('login');
});

Route::any('login',"Admin\AdminController@login");//登陆
//用户登录状态下可以访问的页面
Route::group(['middleware' => 'check.login'], function(){
	Route::any('exit',"Admin\AdminController@login_out");//退出
	Route::any('index',"Admin\AdminController@index");//跳转首页
	Route::any('welcome',"Admin\AdminController@welcome");//首页桌面
	/**后台管理员系列**/
	Route::any('adminList',"Admin\AdminController@adminList");//管理员列表
	Route::any('adminAdd',"Admin\AdminController@addAdmin");//管理员添加
	Route::any('adminDel',"Admin\AdminController@delAdmin");//管理员删除
	Route::any('adminEdit',"Admin\AdminController@adminEdit");//管理员修改
	Route::any('adminSearch',"Admin\AdminController@adminSearch");//管理员搜索
	//RBAC---权限
	Route::any('ruleList',"Admin\PrivilegeController@ruleList");//权限列表
	Route::any('ruleAdd',"Admin\PrivilegeController@ruleAdd");//权限新增
	Route::any('ruleEdit',"Admin\PrivilegeController@ruleEdit");//权限修改
	Route::any('ruleDel',"Admin\PrivilegeController@ruleDel");//权限删除
	//RBAC---角色
	Route::any('roleList',"Admin\PrivilegeController@roleList");//角色列表
	Route::any('roleAdd',"Admin\PrivilegeController@roleAdd");//角色新增
	Route::any('setRule',"Admin\PrivilegeController@setRule");//角色设置权限
	Route::any('roleDel',"Admin\PrivilegeController@roleDel");//角色删除
	Route::any('roleEdit',"Admin\PrivilegeController@roleEdit");//角色修改
});
