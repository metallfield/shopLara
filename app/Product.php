<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    /**
     * @var mixed
     */


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
}
