<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Charge;
use App\Models\ProductItem;
use App\Models\ChargeCanWork;
use App\Http\Requests\ChargeRequest;

class ChargeController extends Controller
{
    public function create()
    {
        return view('charge.create');
    }

    public function store(ChargeRequest $request)
    {
        $input = $request->all();
        $charge = Charge::create($input);
        \Session::flash('flash_message', '担当者を追加しました');
        return redirect (route('charge_can_work.create',[ 'charge' => $charge ]));
    }

    public function index()
    {
        $charges = Charge::paginate(10);
        return view('charge.index', [ 'charges' => $charges ]);
    }

    public function edit($id)
    {
        $charge = Charge::find($id);

        $chargeItems = $charge->find($charge->id)->product_items()->get();
        if (is_null($charge)) {
            \Session::flash('error_message','担当者がいません');
            return redirect (route('charge.index'));
        }
        $product_items = ProductItem::paginate(5);
        return view('charge.edit', [ 'charge' => $charge, 'product_items' => $product_items, 'chargeItems' => $chargeItems ]);
    }

    public function update(ChargeRequest $request, $id)
    {
        $input = $request->all();
        $charge = Charge::find($id);
        $charge->update($input);
        \Session::flash('flash_message', '担当者を更新しました');
        return redirect (route('charge.index'));
    }

    public function destroy($id)
    {
        \Session::flash('flash_message', '担当者を削除しました');
        Charge::destroy($id);
        return redirect (route('charge.index'));
        
    }
}
