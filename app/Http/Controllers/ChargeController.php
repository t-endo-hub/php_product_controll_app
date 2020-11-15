<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Charge;
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
        Charge::create($input);
        \Session::flash('flash_message', '担当者を追加しました');
        return redirect (route('charge.index'));
    }
}
