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
        $itemActCharges = $product_item->charges_can_work()->paginate(5);

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
        $mon4 = date('Y-m-d',strtotime('next monday + 2week'));

        $mondays = [$mon1,$mon2,$mon3,$mon4];
        return view('production_act_on_charge.create', ['product_item' => $product_item, 'charges' => $charges, 'mondays' => $mondays, 'itemActCharges' => $itemActCharges]);
    }

    public function store(ProductionActOnChargeRequest $request)
    {
        $input = $request->all();
        $plan = ProductionPlanOnCharge::where('product_item_id',$input['product_item_id'])->where('charge_id',$input['charge_id'])->where('start_date_of_week',$input['start_date_of_week'])->get();

        // 予定が存在 かつ 予定数>実績数の場合
        if(isset($plan[0]) and $plan[0]->num >= $input['num']){
            $act = ProductionActOnCharge::create($input);
            \Session::flash('flash_message', '生産実績を追加しました');
            return redirect (route('production_act_on_charge.create', [ 'product_item_id' => $request->product_item_id ]));
        // 予定がない もしくは 予定数<実績数の場合
        }else{
            \Session::flash('error_message', '予定数を超過しています');
            return redirect (route('production_act_on_charge.create', [ 'product_item_id' => $request->product_item_id ]));
        }
    }
}
