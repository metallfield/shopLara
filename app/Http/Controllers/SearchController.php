<?php

namespace App\Http\Controllers;

use App\Market;
use App\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $products = $this->productRepository->getForSearch($query);
        return view('search', compact('products'));
    }

    public function nearest(Request $request)
    {
        $product_markets = [];
        $product = $this->productRepository->getProductById($request->product_id);
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
