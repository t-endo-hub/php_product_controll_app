<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChargeCanWork;

class ChargeCanWorkController extends Controller
{
    public function product_item(){
        return $this->hasMany('App\Models\ProductItem');
    }

    public function charge(){
        return $this->hasMany('App\Models\Charge');
    }
}
