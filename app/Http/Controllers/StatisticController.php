<?php

namespace App\Http\Controllers;

 use App\Repositories\ProductRepository;
 use App\Services\StatisticService;
 use Illuminate\Http\Request;

class StatisticController extends Controller
{

    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    private $statisticService;

    public function __construct(StatisticService $statisticService)
    {
        $this->middleware('IsAdmin');
        $this->statisticService = $statisticService;

    }

    public function index()
    {
        return view('statistic.index');
    }

    public function getStatistic()
    {
        $statistic =   $this->statisticService->getProductStatistic();
         return response()->json($statistic);
    }
    public function getTopTrendingProducts()
    {
        $products = $this->statisticService->getMostTrendingProduct();
        return response()->json($products);
    }
}
