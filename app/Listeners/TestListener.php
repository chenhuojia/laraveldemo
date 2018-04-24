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
        if (true) {
            $this->release(30);
        }
        return dd($event->parmas);
    }
    
    
}

