<?php


namespace App\Services;


use App\Repositories\MarketRepository;
use App\User;
use Illuminate\Support\Facades\Auth;

class MarketService
{
    private $marketRepository;
    public function __construct()
    {
        $this->marketRepository = app(MarketRepository::class);
    }

    public function getAllMarkets(?User $user = null)
    {
        return $this->marketRepository->getAllMarkets($user);
    }
    public function createMarket($data)
    {
        $fields = $data;
        $fields['user_id'] = Auth::id();
        return $this->marketRepository->createNewMarket($fields->toArray());
    }
}
