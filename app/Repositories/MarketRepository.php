<?php


namespace App\Repositories;


use App\Market;
use App\Product;
use App\User;

class MarketRepository
{

    public function getAllMarkets(?User $user = null)
    {
        $query = Market::with( 'products', 'user')->orderBy('updated_at', 'desc');
        if($user !== null) {
            $query->where('user_id', $user->id);
        }
        return $query->paginate(6);
    }
    public function attachProduct($product_id, $market_id)
    {
        return Market::find($market_id)->products()->attach($product_id);;
    }

    public function detachProduct($product_id, $market_id){
        return Market::find($market_id)->products()->detach($product_id);
    }
    public function createNewMarket($data)
    {
        return Market::create($data);
    }

    public function updateMarket($data, Market $market)
    {
        return $market->update($data);
    }
}
