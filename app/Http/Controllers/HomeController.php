<?php

namespace App\Http\Controllers;

use App\Category;
use App\Market;
use App\Product;
use App\Repositories\CategoriesRepository;
use App\Repositories\MarketRepository;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController
{
    /**
     * @var Application|mixed
     */
    private $categoriesRepository;
    /**
     * @var Application|mixed
     */
    private $productsRepository;

   /**
 * @var Application|mixed
 */private $marketsRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->productsRepository = app(ProductRepository::class);
        $this->categoriesRepository = app(CategoriesRepository::class);
        $this->marketsRepository = app(MarketRepository::class);

    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $productsQuery = $this->productsRepository->getAllProductsForFilter();
        if ($request->filled('price_from')) {
            $productsQuery->where('price', '>=', $request->price_from)->orderBy('price');
        }
        if ($request->filled('price_to')) {
            $productsQuery->where('price', '<=', $request->price_to)->orderBy('price');
        }

        $products = $productsQuery->paginate(9)->withPath('?'.$request->getQueryString());
        return view('home', ['products' => $products]);
    }

    public function markets()
    {
        $markets = $this->marketsRepository->getAllMarkets();
        return view('markets', compact('markets'));
    }

    public function categories()
    {
        $categories = $this->categoriesRepository->getAllCategories();
        return view('categories', compact('categories'));
    }
    public function categoryShow(Category $category)
    {
        return view('categoryShow', compact('category'));
    }
    public function ProductShow(Product $product)
    {
        $recommendProducts = $this->productsRepository->getRecommendProducts();
        return view('products.show', compact('product', 'recommendProducts'));
    }
    public function MarketShow(Market $market)
    {
        return view('markets.show', compact('market'));
    }



}
