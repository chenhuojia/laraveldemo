<?php
namespace App\Events;
use Illuminate\Console\Scheduling\Event;
class Test extends Event
{   
    protected $parmas;
    
    public function __construct(array $parmas=[])
    {
        $this->parmas = $parmas;
    }
}

