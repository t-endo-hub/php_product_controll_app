@extends('layouts.app')
@section('content')

<div class="container">
  <h2>担当者編集</h2>
  <div class="row mt-4">
    <div class="col-md-4">
      <form action="{{ route ('charge.update', $charge->id) }}" method="POST">
      @method('PATCH')
      @csrf
        <input type="text" name="charge_name" value='{{ $charge->charge_name}}'/>
        <button type="submit" class="btn btn-primary">
          更新
        </button>

        @if ($errors->has('charge_name'))
            <div class="text-danger">
                {{ $errors->first('charge_name') }}
            </div>
        @endif
      </form>
    </div>

    <div class="col-md-8">
      <h2>生産可能アイテム</h2>
      <table class="table">
        <tr>
          <th>生産可能アイテム一覧</th>
          <th>制作時間(単位あたり)</th>
        </tr>
        @foreach($chargeItems as $product_item)
        <tr>
            <input type="hidden" value="{{$charge->id}}">
            <td>{{$product_item->item_name}}</td>
            <td>{{$product_item->pivot->time_required}}</td>
        </tr>
        @endforeach
      </table>
      <div class="d-flex justify-content-center">
        {{ $product_items->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
