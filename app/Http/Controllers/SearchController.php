<?php

namespace App\Http\Controllers;

use App\Market;
use App\Product;
use App\Repositories\ProductRepository;
use App\Services\MarketService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $productRepository;
    private $marketService;

    public function __construct(ProductRepository $productRepository, MarketService $marketService)
    {
        $this->productRepository = $productRepository;
        $this->marketService = $marketService;
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $products = $this->productRepository->getForSearch($query);
        return view('search', compact('products'));
    }

    public function nearest(Request $request)
    {
        $product = $this->productRepository->getProductById($request->product_id);
        $lat = $request->lat;
        $lng = $request->lng;
        $radius =$request->radius ? $request->radius : 200;
        $result = $this->marketService->getMarketsNearMe($product, $lat, $lng, $radius);
        return response()->json($result);
    }
}
