<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChargeCanWork;
use App\Models\Charge;
use App\Models\ProductItem;

class ChargeCanWorkController extends Controller
{
    public function store(Request $request)
    {
        $existsItem = ProductItem::find($request->product_item_id);
        if($existsItem->exists()){
            $input = $request->all();
            ChargeCanWork::create($input);
            \Session::flash('flash_message', '担当者の生産可能アイテムを追加しました');
            return redirect (route('charge.edit', [ 'charge' => $request->charge_id ]));
        } else {
            \Session::flash('error_message', '対象アイテムが存在しません');
            return back();
        }
    }

    public function destroy($product_item_id, $charge_id)
    {
        \Session::flash('flash_message', 'アイテムを削除しました');
        $ChargeCanWork = ChargeCanWork::where('product_item_id',$product_item_id)->where('charge_id',$charge_id)->delete();
        return redirect (route('charge.edit', [ 'charge' => $charge_id ]));
        
    }

}
