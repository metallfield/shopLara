<?php


namespace App\Repositories;


use App\Order;
use App\User;
use Illuminate\Support\Facades\Auth;

class OrderRepository
{

    public function create($data)
    {
        return  Order::create($data);
    }
    public function findOrder($orderId)
    {
            return   Order::findOrFail($orderId);
    }
    public function getMyOrders(User $user)
    {
        return  $user->orders()->Active()->paginate(6);
    }

    public function saveOrder($name, $address, $email, $shipping = null, $order_id, $amount)
    {
        $order = Order::where('id', $order_id)->first();
        if ($order->status == 0) {
            $order->name = $name;
            $order->address = $address;
            $order->email = $email;
            $order->shipping_address =  $shipping ? $shipping : null;
            $order->user_id = Auth::id();
            $order->status = 1;
            $order->amount = $amount;
            $order->save();
            return true;
        }else{
            return false;
        }
    }
    public function getTotalOrdersSum()
    {
       return Order::select('amount')->Active()->sum('amount');
    }

    public function getCountOfOrders()
    {
        return Order::count();
    }
}
