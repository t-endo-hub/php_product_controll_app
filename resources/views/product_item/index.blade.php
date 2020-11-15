@extends('layouts.app')
@section('content')

<div class="container">
  <h2>生産アイテム一覧画面</h2>
  <div class="row">
    <table>
      <tr>
        <th>生産アイテム名</th>
        <th>登録日時</th>
        <th></th>
      </tr>
      @foreach($product_items as $product_item)
      <tr>
        <td>{{$product_item->item_name}}</td>
        <td>{{$product_item->created_at}}</td>
        <td><a class="btn btn-primary" href="/product_item/{{ $product_item->id }}" >編集</a></td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection
