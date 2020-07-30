<?php

namespace App\Http\Middleware;

use App\Order;
use Closure;

class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $orderId = session('orderId');
        if (!is_null($orderId) && session('full_order_sum', 0) > 0) {
            return $next($request);
        }
        session()->flash('warning', 'basket is empty');
        return redirect()->route('home');
    }
}
