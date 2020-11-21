<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Charge;
use App\Models\ChargeCanWork;
use App\Models\ProductItem;
use App\Models\ProductionPlanOnCharge;
use App\Models\ProductionActOnCharge;
use App\Http\Requests\ProductionActOnChargeRequest;
use Carbon\Carbon;


class ProductionActOnChargeController extends Controller
{
    public function create($id)
    {
        // 対象アイテムを取得
        $product_item = ProductItem::find($id);
        $itemActCharges = $product_item->charges_act()->paginate(5);

        // 対象アイテムの生産可能担当者を取得
        $workCanCharges = ChargeCanWork::where('product_item_id',$id)->get('charge_id');
        $charges =[];
        foreach($workCanCharges as $charge)
            {
                $charge = Charge::find($charge->charge_id);
                array_push($charges,$charge);
            }

        $mon1 = date('Y-m-d',strtotime('last monday'));
        $mon2 = date('Y-m-d',strtotime('next monday'));
        $mon3 = date('Y-m-d',strtotime('next monday + 1week'));

        $mons = [$mon1,$mon2,$mon3];
        return view('production_act_on_charge.create', ['product_item' => $product_item, 'charges' => $charges, 'mondays' => $mons, 'itemActCharges' => $itemActCharges]);
    }

    public function store(ProductionActOnChargeRequest $request)
    {
        $input = $request->all();
        $charge = ProductionActOnCharge::create($input);
        \Session::flash('flash_message', '生産実績を追加しました');
        return redirect (route('production_plan_on_charge.index'));
    }


}
