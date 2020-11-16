<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChargeCanWork extends Model
{
    public function charge_can_work(){
        return $this->hasMany('App\Models\ChargeCanWork');
    }
}
