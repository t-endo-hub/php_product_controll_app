<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
