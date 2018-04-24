<?php
namespace App\Listeners;
use App\Events\Test;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestListener implements ShouldQueue
{
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
       
        return dd(11112);
    }
    
    
}

