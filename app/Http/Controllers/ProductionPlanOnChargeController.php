<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Charge;
use App\Models\ChargeCanWork;
use App\Models\ProductItem;
use App\Models\ProductionPlanOnCharge;
use App\Http\Requests\ChargeRequest;
use Carbon\Carbon;

class ProductionPlanOnChargeController extends Controller
{
    public function index()
    {
        $product_items = ProductItem::paginate(10);
        
        $nextMonday = date('m/d',strtotime('next monday'));
        $lastMonday = date('m/d',strtotime('last monday'));
       
        return view('production_plan_on_charge.index',[ 'product_items' => $product_items , 'nextMonday' => $nextMonday, 'lastMonday' => $lastMonday ]);
    }

    public function create($id)
    {
        // 対象アイテムを取得
        $product_item = ProductItem::find($id);

        // 対象アイテムの生産可能担当者を取得
        $workCanCharges = ChargeCanWork::where('product_item_id',$id)->get('charge_id');
        $charges =[];
        foreach($workCanCharges as $charge)
            {
                $hoge = Charge::find($charge->charge_id);
                array_push($charges,$hoge);
            }
        return view('production_plan_on_charge.create', ['product_item' => $product_item, 'charges' => $charges]);
    }
}
