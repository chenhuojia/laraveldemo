<?php
namespace App\Events;
use Illuminate\Console\Scheduling\Event;
class UserAuth extends Event
{
    public function __construct($post=[])
    {
        $this->post = $post;
    }
}

