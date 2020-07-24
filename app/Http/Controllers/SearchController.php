<?php

namespace App\Http\Controllers;

use App\Market;
use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query');
        $products = Product::with('categories')->where('name', 'LIKE', '%' . $query . '%')->get();
        return view('search', compact('products'));
    }

    public function nearest(Request $request)
    {
        $product_markets = [];
        $product = Product::where('id', $request->product_id)->first();
        foreach ($product->markets as $market) {
            $product_markets[] = $market->id;
        }
        $lat = $request->lat;
        $lng = $request->lng;
        $radius =$request->radius ? $request->radius : 200;
        $markets = Market::getByDistant($lat, $lng, $radius);
        foreach ($markets as $market) {
            if (in_array($market->id, $product_markets))
            {
                $result[] = $market;
            }

        }

        return response()->json($result);
    }
}
