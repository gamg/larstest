<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Notifications\CreatedOrderEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCreatedOrderEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $event->order->user->notify(new CreatedOrderEmail($event->order));
    }
}
