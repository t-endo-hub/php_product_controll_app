<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    protected $fillable = ['charge_name'];

    public function charge_can_work(){
        return $this->hasMany('App\Models\ChargeCanWork');
    }
}
