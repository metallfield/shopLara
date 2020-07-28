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

    public function getBasketForAjax()
    {
        $order = (new Basket())->getOrder();
        $products = $order->products;

         return response()->json($order);
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

    public function  basketAdd(Product $product, Request $request){
        $result =  (new Basket(true))->addProduct($product);
        if ($result) {
            session()->flash('success', 'product been added ' . $product->name);
        }else{
            session()->flash('warning', 'product not avaible ' . $product->name);
        }
        if ($request->ajax())
        {
            return response()->json(['status' => 'success']);
        }
        return redirect()->route('basket');
    }

    public function basketRemove(Product $product){
        (new Basket())->removeProduct($product);
        session()->flash('warning', 'product been deleted ' . $product->name);
        return redirect()->route('basket');
    }
}
