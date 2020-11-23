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
      <h2>生産可能アイテム追加</h2>
      <table class="table">
        <tr>
          <th>生産アイテム名</th>
          <th>制作時間(単位あたり)</th>
          <th></th>
        </tr>
        
        <!-- 登録済みのアイテム一覧 -->
        @foreach($chargeItems as $product_item)
          <tr>
            <td>{{$product_item->item_name}}</td>
            <td>{{$product_item->pivot->time_required}}h</td>
            <td>
              <form action="{{ route ('charge_can_work.destroy',[ 'product_item_id' => $product_item->pivot->product_item_id, 'charge_id' => $charge->id ]) }}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger">削除</button> 
              </form>
            </td>
          </tr>
        @endforeach
      </table>
        <!-- ---------------------- -->

        <!-- 新規登録フォーム -->
      <form action="/charge_can_work" method="POST">
      @csrf
        <tr>
          <input type="hidden" name="charge_id" value="{{ $charge->id }}">
          <td>
            <select name="product_item_id">
              @foreach( $product_items as $product_item )
                <option value="{{ $product_item->id }}">{{$product_item->item_name}}</option>
              @endforeach
            </select>
          </td>
          <td><input type="text" name="time_required" placeholder="例）1.5"></td>
          <td>
            <button type="submit" class="btn btn-primary">
              追加
            </button>
            @if ($errors->has('time_required'))
                <div class="text-danger">
                    {{ $errors->first('time_required') }}
                </div>
            @endif
          </td>
        </tr>
      </form>
        <!-- ------------------- -->
        
      <div class="d-flex justify-content-center">
        {{ $chargeItems->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
