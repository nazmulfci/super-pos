<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userCount;

    public function __construct($userCount)
    {
        $this->userCount = $userCount;
    }

    public function broadcastOn()
    {
        return ['user-channel'];
    }

    public function broadcastAs()
    {
        return 'UserDeleted';
    }
}
