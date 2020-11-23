@extends('layouts.app')
@section('content')

<div class="container">
  <h2>生産アイテム編集</h2>
  <div class="row mt-4">
    <form action="{{ route ('product_item.update', $product_item->id) }}" method="POST">
    @method('PATCH')
    @csrf
      <input type="text" name="item_name" value='{{ $product_item->item_name}}'/>
      <button type="submit" class="btn btn-primary">
        更新
      </button>

      @if ($errors->has('item_name'))
        <div class="text-danger">
            {{ $errors->first('item_name') }}
        </div>
      @endif
    </form>

    <form action="{{ route ('product_item.destroy', $product_item->id) }}" method="POST">
    @method('DELETE')
    @csrf
      <button type="submit" class="btn btn-danger">削除</button>
    </form>
  </div>
</div>
@endsection
