<?php

namespace App\Http\Controllers;

 use App\Http\Requests\OrderRequest;
 use App\Order;
use App\Product;
use App\Services\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{


    public function basket(){
        $order = (new Basket())->getOrder();
         return view('basket', compact('order'));
    }

    public function basketConfirm(OrderRequest $request){

        $email = Auth::check() ? Auth::user()->email : $request->email;
        $name = Auth::check() ? Auth::user()->name : $request->name;
        $success = (new Basket())->saveOrder($name, $request->address, $email);

        if ($success) {
            session()->flash('success', 'ваш заказ принят на обработку');
        }else{
            session()->flash('warning', 'шо то не так');
        }

        Order::eraseOrderSum();

        return redirect()->route('home');
    }

    public function basketPlace(){
         $basket = new Basket();
        $order = $basket->getOrder();
        if (!$basket->countAvailable()) {
            session()->flash('warning', 'product not avaible ');
            return redirect()->route('basket');
        }
        return view('order', compact([ 'order']));
    }

    public function  basketAdd(Product $product){
        $result =  (new Basket(true))->addProduct($product);
        if ($result) {
            session()->flash('success', 'product been added ' . $product->name);
        }else{
            session()->flash('warning', 'product not avaible ' . $product->name);
        }

        return redirect()->route('basket');
    }

    public function basketRemove(Product $product){
        (new Basket())->removeProduct($product);
        session()->flash('warning', 'product been deleted ' . $product->name);
        return redirect()->route('basket');
    }
}
