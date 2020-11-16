@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-4">
      <h2>担当者名</h2>
      <h3>{{ $charge->charge_name}}</h3>
    </div>

    <div class="col-md-8">
      <h2>生産可能アイテム追加</h2>
        <form action="/charge_can_work" method="POST">
        @csrf
          <table class="table">
            <tr>
              <th>生産アイテム名</th>
              <th>制作時間(単位あたり)</th>
              <th></th>
            </tr>
            <tr>
              <input type="hidden" name="charge_id" value="{{ $charge->id }}">
              <td>
                  <select name="product_item_id">
                  @foreach( $product_items as $product_item )
                    <option value="{{ $product_item->id }}">{{$product_item->item_name}}</option>
                  @endforeach
                  </select>
              </td>
              <td><input type="text" name="time_required" value="時間"></td>
              <button type="submit" class="btn btn-primary">
                追加
              </button>
            </tr>
          </table>
        </form>
          
        
      <div class="d-flex justify-content-center">
        {{ $product_items->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
