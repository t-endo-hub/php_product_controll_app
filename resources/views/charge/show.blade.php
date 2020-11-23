@extends('layouts.app')
@section('content')

<div class="container">
  <h2>担当者名</h2>
  <div class="row mt-4">
    <div class="col-md-4">
      <h3>{{ $charge->charge_name }}</h3>
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
            <td>{{$product_item->item_name}}</td>
            <td>{{$product_item->pivot->time_required}}h</td>
          </tr>
        @endforeach
      </table>
      <div class="d-flex justify-content-center">
        {{ $chargeItems->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
