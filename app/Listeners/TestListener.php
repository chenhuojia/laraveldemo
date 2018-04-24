<?php
namespace App\Listeners;
use App\Events\Test;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TestListener implements ShouldQueue
{
    use InteractsWithQueue;
    
    public function __construct()
    {
        //
    }
    
    /**
     * 处理事件.
     *
     * @param  OrderShipped  $event
     * @return void
     */
    public function handle(Test $event)
    {   
        
        dump($event->parmas);
    }
    
    /**
     * 失败事件处理器
     *
     * @param  \App\Events\Test  $event
     * @param  \Exception  $exception
     * @return void
     */
    public function failed(Test $event, $exception)
    {
        dump($event->parmas);
    }
    
}

