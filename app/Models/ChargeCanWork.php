<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChargeCanWork extends Model
{
    public function product_item(){
        return $this->belongsTo('App\Models\ProductItem');
    }

    public function charge(){
        return $this->belongsTo('App\Models\Charge');
    }
}