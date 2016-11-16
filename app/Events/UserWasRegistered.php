<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Session;

class UserWasRegistered extends Event
{
    use SerializesModels;

    public $user;

    protected $listen = [
    'App\Events\UserWasRegistered' => [
        'App\Listeners\EventListener',
    ],
];

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
        /*echo $user->last_name;
        Session::flash('success', 'bine');*/
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        //return [];
         //Session::flash('success', 'bine');

         return ['user.'.$this->user->id];
    }

    
}
