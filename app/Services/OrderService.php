<?php


namespace App\Services;


use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function getIncomingOrders()
    {
        foreach (Auth::user()->products as $product)
        {
            if ($product->orders->count() > 0)
            {
                foreach ($product->orders as $order)
                {
                    if ($order->status === 1)
                    {
                        $orders[] = $order;
                    }

                }

            }
        }
        return $orders ? $orders :null;
    }
}
