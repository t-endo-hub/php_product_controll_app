@extends('layouts.app')
@section('content')

<div class="container">
    <h2>生産アイテム編集登録画面</h2>
    <form action="{{route('product_item.update')}}" method="POST">
    @csrf
      <div>
        <label>アイテム名</label><br>
        <input type="hidden" name="id" value="{{ $product_item->id }}">
        <input type="text" name="item_name" value='{{ $product_item->item_name}}'/>
        <button type="submit" class="btn btn-primary">
          更新
        </button>

        @if ($errors->has('item_name'))
            <div class="text-danger">
                {{ $errors->first('item_name') }}
            </div>
        @endif

      </div>
    </form>
</div>
@endsection
