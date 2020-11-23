@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row mb-2">
    <h2>生産アイテム一覧</h2>
    <a class="btn btn-primary ml-3" href="{{ route('product_item.create') }}">
        新規アイテム追加
    </a>
  </div>
  <div class="row">
    <table class="table">
      <tr>
        <th>生産アイテム名</th>
        <th>登録日時</th>
        <th></th>
      </tr>
      @foreach($product_items as $product_item)
        <tr>
          <td>{{$product_item->item_name}}</td>
          <td>{{$product_item->created_at}}</td>
          <td><a class="btn btn-primary" href="{{ route ('product_item.edit', $product_item->id) }}" >編集</a></td>
        </tr>
      @endforeach
    </table>
  </div>
  <div class="d-flex justify-content-center">
    {{ $product_items->links() }}
  </div>
</div>

@endsection
