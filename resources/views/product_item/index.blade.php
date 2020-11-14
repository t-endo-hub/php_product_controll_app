@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row">
    <table>
      <tr>
        <th>生産アイテム名</th>
        <th>登録日時</th>
      </tr>
      @foreach($product_items as $product_item)
      <tr>
        <td>{{$product_item->item_name}}</td>
        <td>{{$product_item->created_at}}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection
