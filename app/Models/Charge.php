<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    protected $fillable = ['charge_name'];

    public function product_items()    
    {
        return $this->belongsToMany('App\Models\ProductItem',
                                    'charge_can_works',
                                    'charge_id',
                                    'product_item_id');
    }
}
