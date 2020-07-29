<?php

namespace App\Http\Controllers;

use App\Market;
use App\Repositories\ProductRepository;
use App\Services\MarketService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketController extends Controller
{
private $marketService;
    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    private $productRepository;

    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');
        $this->marketService = $marketService;
        $this->productRepository = app(ProductRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $markets = $this->marketService->getAllMarkets(Auth::user());
        return view('markets.index', compact('markets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('markets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = collect($request->all());
        $user_id = Auth::user();
        $result = $this->marketService->createMarket($data, $user_id);
        if ($result)
        {
            return redirect()->route('markets.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Market  $market
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market)
    {
        return view('markets.show', compact('market'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Market  $market
     * @return \Illuminate\Http\Response
     */
    public function edit(Market $market)
    {
        if ($this->marketService->checkOwner($market, Auth::user()))
        {
            return view('markets.edit', compact('market'));
        }else{
            return  redirect()->back();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Market  $market
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Market $market)
    {
        if ($this->marketService->checkOwner($market, Auth::user())) {
            $data = collect($request->all());
            $user = Auth::user();
            $result = $this->marketService->updateMarket($data, $market, $user);
            if ($result) {
                return redirect()->route('markets.index');
            } else {
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Market  $market
     * @return \Illuminate\Http\Response
     */
    public function destroy(Market $market)
    {
        if ($this->marketService->checkOwner($market, Auth::user())) {
            if ($market->delete()) {
                return redirect()->route('markets.index');
            } else {
                return false;
            }
        }else{
            return redirect()->back();
        }
    }

    public function MarketProducts(Market $market)
    {
        $products = $this->productRepository->getAllProducts(Auth::user());
        return view('markets.products', compact('products', 'market'));
    }

    public function addProduct(Request $request)
    {
        $product_id = $request->get('product_id');
        $market_id = $request->get('market_id');
        $result = $this->marketService->attachProduct($product_id , $market_id);

        if ($result)
        {
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'fail']);
        }
    }

    public function removeProduct(Request $request)
    {
        $product_id = $request->get('product_id');
        $market_id = $request->get('market_id');
        $result = $this->marketService->detachProduct($product_id, $market_id);
        if ($result)
        {
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'fail']);
        }
    }
}
