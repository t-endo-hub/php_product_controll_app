<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    protected $fillable = ['item_name'];

    public function charge_can_work(){
        return $this->hasMany('App\Models\ChargeCanWork');
    }
}
