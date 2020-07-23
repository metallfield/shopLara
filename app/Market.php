<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Market extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function isAddedProduct($id)
    {
        $productArr = [];
        foreach ($this->products as $product) {
            $productArr[] = $product->id;
        }
        if (in_array($id, $productArr))
        {
            return true;
        }else{
            return  false;
        }
    }

    public function scopeGetByDistant($query, $lat, $lng, $radius )
    {
        $results = DB::select(DB::raw('SELECT *, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $lng . ') ) + sin( radians(' . $lat .') ) * sin( radians(lat) ) ) ) AS distance FROM markets HAVING distance < ' . $radius . ' ORDER BY distance') );
        if(!empty($results)) {

            $ids = [];

            foreach($results as $q) {
                array_push($ids, $q->id);
            }

            return $results;

        }

        return $query;
    }
}
