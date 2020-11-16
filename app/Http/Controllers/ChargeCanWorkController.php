<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChargeCanWork;
use App\Models\Charge;
use App\Models\ProductItem;

class ChargeCanWorkController extends Controller
{
    public function create($charge)
    {
        $charge = Charge::find($charge);
        $product_items = ProductItem::paginate(5);
        return view('charge_can_work.create',[ 'product_items' => $product_items, 'charge' => $charge ]); 
                                               
    }

    public function store(Request $request)
    {
        $input = $request->all();
        ChargeCanWork::create($input);
        \Session::flash('flash_message', '担当者の生産可能アイテムを追加しました');
        return redirect (route('charge.index'));
    }
}
