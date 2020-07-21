<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repositories\CategoriesRepository;
use App\Repositories\MarketRepository;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = $this->productsRepository->getAllProducts();
        return view('home', compact('products'));
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


}
