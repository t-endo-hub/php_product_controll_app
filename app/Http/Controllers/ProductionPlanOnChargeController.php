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

        $mons = [$mon1,$mon2,$mon3];

        return view('production_plan_on_charge.index',['product_items' => $product_items, "mons" => $mons ]);
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

        $mon1 = date('Y-m-d' ,strtotime('next monday' ));
        $mon2 = date('Y-m-d',strtotime('next monday + 1week'));
        $mon3 = date('Y-m-d',strtotime('next monday + 2week'));

        $mons = [$mon1,$mon2,$mon3];
        return view('production_plan_on_charge.create', ['product_item' => $product_item, 'charges' => $charges, 'mondays' => $mons, 'itemPlanCharges' => $itemPlanCharges]);
    }

    public function store(ProductionPlanOnChargeRequest $request)
    {
        $input = $request->all();
        $charge = ProductionPlanOnCharge::create($input);
        \Session::flash('flash_message', '生産予定を追加しました');
        return redirect (route('production_plan_on_charge.index'));
    }
}
