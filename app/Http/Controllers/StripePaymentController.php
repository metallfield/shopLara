<?php

namespace App\Http\Controllers;

 use App\Http\Requests\OrderRequest;
 use App\Order;
use App\Services\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;
class StripePaymentController extends Controller
{

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $email = Auth::check() ? Auth::user()->email : $request->email;
        $name = Auth::check() ? Auth::user()->name : $request->name;
        $billing_address = $request->address ? $request->address : null;
        $shipping = $request->shipping_address ? $request->shipping_address : null;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            Stripe\Charge::create ([
                "amount" => $request->get('amount') * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from shop.loc."
            ]);
            $order_id = session('orderId');
            $success = (new Basket(Auth::user()))->saveOrder($name, $billing_address, $email, $shipping, $order_id, $request->amount);
            if ($success) {
                session()->forget('orderId');
                session()->flash('success', 'Payment successful!');
                return redirect()->route('orders.index');
                }else{
                session()->flash('warning', 'шо то не так');
                return redirect()->back();
            }
                 session()->forget('full_order_sum');

    }
}
