@extends('layouts.app')
@section('content')

<div class="container">
  <h2>生産アイテム新規登録</h2>
  <form action="{{route('product_item.store')}}" method="POST">
  @csrf
    <div>
      <label>アイテム名</label><br>
      <input type="text" name="item_name" />
      <button type="submit" class="btn btn-primary">
        追加
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
