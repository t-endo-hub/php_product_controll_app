<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChargeCanWork;
use App\Models\Charge;
use App\Models\ProductItem;
use App\Http\Requests\ChargeCanWorkRequest;


class ChargeCanWorkController extends Controller
{
    public function store(ChargeCanWorkRequest $request)
    {
        // すでに存在しているアイテムかどうか
        $alredyItem = ChargeCanWork::where('product_item_id',$request->product_item_id)->where('charge_id',$request->charge_id)->exists();

        if($alredyItem){
            // アイテムがすでに存在している場合の処理
            \Session::flash('error_message', 'すでにアイテムは登録されています');
            return redirect (route('charge.edit', [ 'charge' => $request->charge_id ]));
        } else {
            // アイテムを新規登録する場合の処理
            $input = $request->all();
            
            ChargeCanWork::create($input);
            \Session::flash('flash_message', '担当者の生産可能アイテムを追加しました');
            return redirect (route('charge.edit', [ 'charge' => $request->charge_id ]));
        }
    }

    public function destroy($product_item_id, $charge_id)
    {
        \Session::flash('flash_message', 'アイテムを削除しました');
        $ChargeCanWork = ChargeCanWork::where('product_item_id',$product_item_id)->where('charge_id',$charge_id)->delete();
        return redirect (route('charge.edit', [ 'charge' => $charge_id ]));
        
    }

}
