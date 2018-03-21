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
        //不需要token权限
        $api->get('user-token','V1\TokenController@getToken');
    
        //需要token权限
        $api->group(['middleware'=>['userAuth']],function ($api){
        
            $api->post('getUser','TokenController@getUser');
        
        });
    });
});

