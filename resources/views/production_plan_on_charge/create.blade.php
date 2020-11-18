@extends('layouts.app')
@section('content')

<div class="container">
  <h2>生産予定登録画面</h2>
  <div class="row mt-4">
    <div class="col-md-4">
      <h3>{{ $product_item->item_name }}</h3>
    </div>

    <div class="col-md-8">
      <table class="table">
        <tr>
          <th>担当者選択</th>
          <th>生産予定数</th>
        </tr>

        <form action="/production_plan_on_charge" method="POST">
        @csrf
          <tr>
            <td>
              <select name="product_item_id">
                @foreach( $charges as $charge )
                  <option value="{{ $charge->id }}">{{$charge->charge_name}}</option>
                @endforeach
              </select>
            </td>
            <td><input type="text" name="num" placeholder="例）100"></td>
            <td>
              <button type="submit" class="btn btn-primary">
                追加
              </button>
              @if ($errors->has('num'))
                  <div class="text-danger">
                      {{ $errors->first('num') }}
                  </div>
              @endif
            </td>
          <tr>
        </form>
      </table>
      
    </div>
  </div>
</div>
@endsection
