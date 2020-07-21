<?php


namespace App\Services;


use App\Market;
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
        $fields['name'] = $data->get('name');
        $fields['description'] = $data->get('description');
        $fields['location'] = $data->get('address_address');
        $fields['lat'] = $data->get('address_latitude');
        $fields['lng'] = $data->get('address_longitude');
        $fields['user_id'] = Auth::id();
        return $this->marketRepository->createNewMarket($fields);
    }

    public function updateMarket($data, Market $market)
    {
        $fields['name'] = $data->get('name');
        $fields['description'] = $data->get('description');
        $fields['location'] = $data->get('address_address');
        $fields['lat'] = $data->get('address_latitude');
        $fields['lng'] = $data->get('address_longitude');
        $fields['user_id'] = Auth::id();
        $result = $this->marketRepository->updateMarket($fields, $market);
        if ($result)
        {
            return true;
        }else{
            return false;
        }
    }
    public function checkOwner(Market $market)
    {
        if (Auth::id() === $market->user_id && $market->user_id !== null)
        {
            return true;
        }
        else{
            return  false;
        }
    }
}
