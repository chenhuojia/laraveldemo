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


Route::group(['namespace'=>'Api','prefix' =>'{version}'],function (){
    //不需要token权限
    Route::get('getToken','TokenController@getToken');
    
    //需要token权限
    Route::middleware(['userAuth'])->group(function (){
        
        Route::post('getUser','TokenController@getUser');
        
    });
});
