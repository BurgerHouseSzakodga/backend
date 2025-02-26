<?php

namespace App\Observers;

use App\Models\Basket;
use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        $userId = $order->user_id;

        $basket = Basket::with(['items.extras'])->where('user', $userId)->first();

        if ($basket) {
            foreach ($basket->items as $item) {
                $item->extras()->delete();
                $item->delete();
            }

            $basket->update(['total_amount' => 0]);
        }
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
