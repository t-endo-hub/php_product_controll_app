<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Charge;
use App\Models\ChargeCanWork;
use App\Models\ProductItem;
use App\Models\ProductionPlanOnCharge;
use App\Http\Requests\ProductionPlanOnChargeRequest;
use Carbon\Carbon;

class ProductionPlanOnChargeController extends Controller
{
    public function index()
    {
        $product_items = ProductItem::paginate(10);
        $mon1 = date('Y-m-d',strtotime('last monday' ));
        $mon2 = date('Y-m-d',strtotime('next monday'));
        $mon3 = date('Y-m-d',strtotime('next monday + 1week'));
        $mon4 = date('Y-m-d',strtotime('next monday + 2week'));

        $mondays = [$mon1,$mon2,$mon3,$mon4];

        return view('production_plan_on_charge.index',['product_items' => $product_items, "mondays" => $mondays ]);
    }

    public function create($id)
    {
        // 対象アイテムを取得
        $product_item = ProductItem::find($id);
        $itemPlanCharges = $product_item->charges_time_required()->paginate(5);

        // 対象アイテムの生産可能担当者を取得
        $workCanCharges = ChargeCanWork::where('product_item_id',$id)->get('charge_id');
        $charges =[];
        foreach($workCanCharges as $charge)
            {
                $charge = Charge::find($charge->charge_id);
                array_push($charges,$charge);
            }

        $mon1 = date('Y-m-d',strtotime('last monday'));
        $mon2 = date('Y-m-d' ,strtotime('next monday' ));
        $mon3 = date('Y-m-d',strtotime('next monday + 1week'));
        $mon4 = date('Y-m-d',strtotime('next monday + 2week'));

        $mondays = [$mon1,$mon2,$mon3,$mon4];
        return view('production_plan_on_charge.create', ['product_item' => $product_item, 'charges' => $charges, 'mondays' => $mondays, 'itemPlanCharges' => $itemPlanCharges]);
    }

    public function store(ProductionPlanOnChargeRequest $request)
    {

        // すでに存在しているアイテムかどうか
        $alredyPlan = ProductionPlanOnCharge::where('start_date_of_week',$request->start_date_of_week)->where('charge_id',$request->charge_id)->where('product_item_id', $request->product_item_id)->exists();

        if($alredyPlan){
            // アイテムがすでに存在している場合の処理
            \Session::flash('error_message', '予定は既に登録されています');
            return redirect (route('production_plan_on_charge.create', [ 'product_item_id' => $request->product_item_id ]));
        } else {
            // アイテムを新規登録する場合の処理
            $input = $request->all();
            ProductionPlanOnCharge::create($input);
            \Session::flash('flash_message', '予定を追加しました');
            return redirect (route('production_plan_on_charge.create', [ 'product_item_id' => $request->product_item_id ]));
        }
        
    }
}
