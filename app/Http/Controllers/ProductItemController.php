<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductItem;

class ProductItemController extends Controller
{
    public function index()
    {
        return view('product_item.index');
    }

    public function create()
    {
        return view('product_item.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        ProductItem::create($input);
        return redirect(route('product_item.index'))->with('flash_message', 'アイテムを追加しました');
    }
}
