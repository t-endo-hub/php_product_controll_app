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
                                    'charge_id')->withPivot('time_required');

        return $this->belongsToMany('App\Models\Charge',
                                    'production_plan_on_charges',
                                    'product_item_id',
                                    'charge_id')->withPivot('num');
    }
}
