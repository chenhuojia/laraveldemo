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
    
        //需要token权限
        $api->group(['middleware'=>['userAuth']],function ($api){
            //获取用户信息
            $api->get('user','V1\TokenController@getUser');
            
            //发布blog
            $api->post('blog','V1\BlogController@createBlog');
            
            //更新blog
            $api->patch('blog','V1\BlogController@updateBlog');
            
        });
    });
});

