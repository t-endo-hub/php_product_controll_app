<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    protected $fillable = ['item_name'];

    public function charges()
    {
        return $this->belongsToMany('App\Models\Charge',
                                    'charge_can_works',
                                    'product_item_id',
                                    'charge_id');
    }
}
