<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionPlanOnCharge extends Model
{
    protected $fillable = ['product_item_id', 'charge_id', 'start_date_of_week', 'num'];

    public function product_item(){
        return $this->belongsTo('App\Models\ProductItem');
    }

    public function charge(){
        return $this->belongsTo('App\Models\Charge');
    }

}
