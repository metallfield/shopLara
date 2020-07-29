<?php


namespace App\Services;


use App\Market;
use App\Product;
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
    public function createMarket($data, User $user)
    {
        $fields['name'] = $data->get('name');
        $fields['description'] = $data->get('description');
        $fields['location'] = $data->get('address_address');
        $fields['lat'] = $data->get('address_latitude');
        $fields['lng'] = $data->get('address_longitude');
        $fields['user_id'] = $user;
        return $this->marketRepository->createNewMarket($fields);
    }

    public function updateMarket($data, Market $market, User $user)
    {
        $fields['name'] = $data->get('name');
        $fields['description'] = $data->get('description');
        $fields['location'] = $data->get('address_address');
        $fields['lat'] = $data->get('address_latitude');
        $fields['lng'] = $data->get('address_longitude');
        $fields['user_id'] = $user;
        $result = $this->marketRepository->updateMarket($fields, $market);
        if ($result)
        {
            return true;
        }else{
            return false;
        }
    }
    public function checkOwner(Market $market, User $user)
    {
        if ($user === $market->user_id && $market->user_id !== null)
        {
            return true;
        }
        else{
            return  false;
        }
    }
    public function attachProduct($product_id, $market_id)
    {
        return $this->marketRepository->attachProduct($product_id, $market_id);
    }

    public function detachProduct($product_id, $market_id)
    {
        return $this->marketRepository->detachProduct($product_id, $market_id);
    }

    public function getMarketsNearMe($product, $lat, $lng, $radius)
    {
        foreach ($product->markets as $market) {
            $product_markets[] = $market->id;
        }
        $earth_rad = 6378;
        $maxLat = $lat + rad2deg($radius/$earth_rad);
        $maxLon = $lng + rad2deg(asin($radius/$earth_rad) / cos(deg2rad($lat)));
        $markets = $this->marketRepository->getNearestMarkets($maxLat, $maxLon);

        foreach ($markets as $market) {
            $latitudeFrom = $lat;
            $longitudeFrom = $lng;

            $latitudeTo = $market->lat;
            $longitudeTo = $market->lng;

             $theta = $longitudeFrom - $longitudeTo;
            $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;

            $distance = ($miles * 1.609344);
            if (in_array($market->id, $product_markets))
            {
                $market['distance'] = $distance;
                $result[] = $market;
            }

        }
        return $result ? $result : null;
    }
}
