<?php

//use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

$api=app('Dingo\Api\Routing\Router');
$api->version('v1',function ($api){
    $api->group(['namespace'=>'App\Http\Controllers\Api'],function ($api){
        //获取token
        $api->post('user-token','V1\TokenController@getToken');
        //所有学校
        $api->get('school','V1\SchoolController@school');
        
        //需要token权限
        $api->group(['middleware'=>['userAuth']],function ($api){
            //获取用户信息
            $api->get('user','V1\TokenController@getUser');
            
            //添加学校
            $api->post('school','V1\SchoolController@store');
            //绑定学校
            $api->put('bind-school','V1\SchoolController@getSection');
            
            //部门
            $api->resource('section','V1\SectionController',['only'=>['store','update','destroy']]);
                       
            //获取当前学校部门
            $api->get('school-section','V1\SchoolController@getSection');
            
            
            
            //发布blog||更新blog
            $api->resource('blog','V1\BlogController',['only'=>['store','update']]); 
            
        });
    });
});

