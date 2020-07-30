<?php

namespace App\Http\Controllers;

use App\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    private $orderService;
    public function  __construct(OrderService $orderService)
    {
        $this->middleware('auth');
        $this->orderService = $orderService;
    }

    public function index()
    {
         $orders = $this->orderService->getMyOrders(Auth::user());
        return view('orders.index', compact([ 'orders']));
    }
    public function show(Order $order){
         if (!Auth::user()->orders->contains($order)) {
            return back();
        }
         return view('orders.show', compact('order'));
    }

    public function incomingOrders()
    {
        $orders = $this->orderService->getIncomingOrders(Auth::user());

        return view('orders.incoming', compact('orders'));
    }
    public function incomingOrderShow(Order $order)
    {
            return view('orders.incoming_show', compact('order'));
    }
}
