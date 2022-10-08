<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        Log::create([
            'user_id' => $order->user->id,
            'order_id' => $order->id,
            'event' => 'Order created',
        ]);
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        Log::create([
            'user_id' => $order->user->id,
            'order_id' => $order->id,
            'event' => 'Order updated',
        ]);
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        Log::create([
            'user_id' => $order->user->id,
            'order_id' => $order->id,
            'event' => 'Order deleted',
        ]);
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
