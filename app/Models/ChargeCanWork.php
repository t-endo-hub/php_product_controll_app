<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChargeCanWork extends Model
{
    protected $fillable = ['charge_id', 'product_item_id', 'time_required'];

    public function product_item(){
        return $this->belongsTo('App\Models\ProductItem');
    }

    public function charge(){
        return $this->belongsTo('App\Models\Charge');
    }
}