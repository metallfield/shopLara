<?php

namespace App\Http\Controllers;

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
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {

        $email = Auth::check() ? Auth::user()->email : $request->email;
        $name = Auth::check() ? Auth::user()->name : $request->name;
        $billing_address = $request->address ? $request->address : null ;
        $shipping = $request->shipping_address ? $request->shipping_address : null;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            Stripe\Charge::create ([
                "amount" => $request->get('amount') * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
            ]);

            $success = (new Basket())->saveOrder($name, $billing_address, $email, $shipping);
            if ($success) {

                session()->flash('success', 'Payment successful!');
                return redirect()->route('orders.index');
                }else{
                session()->flash('warning', 'шо то не так');
                return redirect()->back();
            }
                Order::eraseOrderSum();

    }
}