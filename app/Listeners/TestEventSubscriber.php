<?php
/**
* 测试事件订阅 文件
* @date: 2018年4月25日
* @author: chj
* @version: 1.0.0
*/
namespace App\Listeners;
use Illuminate\Support\Facades\DB;
class TestEventSubscriber{
    
    public function onTest($event){
        $time=microtime();
        DB::table('users')->insert(
            ['name' => $time, 'email' =>$time,'password'=>$time]
         );
    }
    
    /**
     * 为订阅者注册监听器。
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events){
        $events->listen(
            'App\Events\Test',
            'App\Listeners\TestEventSubscriber@onTest'
        );
    }
    
}