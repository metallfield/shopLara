<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use softDeletes;
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function markets()
    {
        return $this->belongsToMany(Market::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function isSelectedCategory($id)
    {
        $categoryArr = [];
        foreach ($this->categories as $category)
        {
            $categoryArr[] = $category->id;
        }

        if (in_array($id, $categoryArr)){

            return true;
        }
    }

    public function getPriceForCount(){
        if (!is_null($this->pivot)) {
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }
    public function countProduct(){

        return $this->pivot->count;
    }

    public function isAvaible(){

        return $this->count > 0 && !$this->trashed();
    }
}
