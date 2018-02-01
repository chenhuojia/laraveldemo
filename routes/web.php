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
Route::get('/',['uses'=>'Admin\IndexController@index','middleware' => 'rbac']);
Route::group(['namespace' => 'Admin','prefix'=>'admin'],function (){
        Route::get('login','LoginController@index')->name('admin.login'); //登录页面
        Route::post('login-handle','LoginController@login')->name('login.handle'); //登录操作
        Route::any('logout','LoginController@logout')->name('admin.logout'); //退出登录
        Route::middleware(['rbac'])->group(function (){
            Route::get('index','IndexController@index')->name('admin.index'); //后台首页
            Route::resource('admins','AdminsController',['only'=>['index','store','create','edit','update','destroy']]); //管理员
            Route::resource('role','RolesController',['only'=>['index','store','create','edit','update','destroy']]); //角色
            Route::resource('rule','RulesController',['only'=>['index','store','create','edit','update','destroy']]); //权限
            Route::get('role/access/{id}','RolesController@access')->name('role.access');//权限分配页面
            Route::post('role/group-access/{id}','RolesController@groupAccess')->name('role.group.access');//权限分配 操作
        }); 
});

