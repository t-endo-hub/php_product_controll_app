<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    protected $fillable = ['charge_name'];

    public function product_items_time_required()    
    {
        return $this->belongsToMany('App\Models\ProductItem',
                                    'charge_can_works',
                                    'charge_id',
                                    'product_item_id')->withPivot('time_required');
    }

    public function product_items_plan()    
    {
        return $this->belongsToMany('App\Models\ProductItem',
                                    'production_plan_on_charges',
                                    'charge_id',
                                    'product_item_id')->withPivot('num','start_date_of_week');
    }

    public function product_items_act()    
    {
        return $this->belongsToMany('App\Models\ProductItem',
                                    'production_act_on_charges',
                                    'charge_id',
                                    'product_item_id')->withPivot('num','start_date_of_week');
    }
}
