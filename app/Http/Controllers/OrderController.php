<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function  __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
         $orders = Auth::user()->orders()->Active()->paginate(8);

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

    }
}
