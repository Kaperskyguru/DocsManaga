<?php

namespace App\Listeners;

use App\Events\LogMonologEvent;
use App\Log;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogMonologEventListener implements ShouldQueue
{

    public $queue = 'logs';
    protected $log;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    /**
     * @param $event
     */
    public function onLog($event)
    {

        $data = $event->records['formatted'];
        $log = new $this->log;
        $log->origin = $data['origin'];
        $log->ip = $data['ip'];
        $log->description = $data['description'];
        $log->user_agent = $data['user_agent'];
        $log->token = $data['token'];
        // $log->result = $data['result'];
        $log->level = $data['level'];
        $log->user_id = $data['user_id'];
        $log->save();

    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {

        $events->listen(
            LogMonologEvent::class,
            'App\Listeners\LogMonologEventListener@onLog'
        );
    }
}
