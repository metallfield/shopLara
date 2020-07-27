<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Product;
use App\Repositories\CategoriesRepository;
use App\Services\ProductsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{

    /**
     * @var ProductsService
     */
    private $productsService;
    /**
     * @var CategoriesRepository
     */
    private $categoriesRepository;

    public function __construct(ProductsService $productsService, CategoriesRepository $categoriesRepository)
    {
        $this->productsService = $productsService;
        $this->middleware('auth');
        $this->categoriesRepository = $categoriesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productsService->getAllProducts(Auth::user());
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =  $this->categoriesRepository->getAllCategories();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = collect($request->all());
         $this->productsService->createProduct($data);
            return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $recommendProducts = $this->productsService->getRecommendProducts();

        return view('products.show', compact('product', 'recommendProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $checkOwner = $this->productsService->CheckOwner($product);
        if ($checkOwner)
        {
            $categories = $this->categoriesRepository->getAllCategories();
            return view('products.edit', compact('categories', 'product'));
        }else{
            return redirect()->back();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Product $product)
    {
        $data = collect($request->all());
        $this->productsService->updateProduct($data, $product);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $checkOwner = $this->productsService->CheckOwner($product);
        if ($checkOwner) {
            if ($product->delete()) {
                return redirect()->back();
            } else {
                session()->flash('warning', 'can`t delete this product ');

                return false;
            }
        }else{
            return redirect()->back();
        }
    }
}
