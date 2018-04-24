<?php
namespace App\Events;
use Illuminate\Console\Scheduling\Event;
class Test extends Event
{   
    public $parmas;
    
    public function __construct( $parmas=[])
    {
        $this->parmas = $parmas;
    }
}

