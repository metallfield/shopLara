<?php


namespace App\Services;


use App\Repositories\OrderRepository;
use App\User;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getMyOrders(User $user)
    {
        return $this->orderRepository->getMyOrders($user);
    }
    public function getIncomingOrders(User $user)
    {
        foreach ($user->products->load('user') as $product)
        {
            if ($product->orders->count() > 0)
            {
                foreach ($product->orders->load('products') as $order)
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
