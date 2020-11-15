<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductItem;
use App\Http\Requests\ProductItemRequest;

class ProductItemController extends Controller
{
    public function index()
    {
        $product_items = ProductItem::all();
        return view('product_item.index',[ 'product_items' => $product_items ]);
    }

    public function create()
    {
        return view('product_item.create');
    }

    public function store(ProductItemRequest $request)
    {
        $input = $request->all();
        ProductItem::create($input);
        \Session::flash('flash_message', 'アイテムを追加しました');
        return redirect (route('product_item.index'));
    }

    public function edit($id)
    {
        $product_item = ProductItem::find($id);
        if (is_null($product_item)) {
            \Session::flash('error_message','アイテムがありません');
            return redirect (route('product_item.index'));
        }
        return view('product_item.edit',[ 'product_item' => $product_item ]);
    }

    public function update(ProductItemRequest $request)
    {
        $input = $request->all();
        $product_item = ProductItem::find($input['id']);
        $product_item->update($input);
        \Session::flash('flash_message', 'アイテムを更新しました');
        return redirect (route('product_item.index'));
    }

}
