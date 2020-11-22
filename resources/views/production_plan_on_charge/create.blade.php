@extends('layouts.app')
@section('content')

<div class="container">
  <h2>予定登録</h2>
  <div class="row mt-4">
    <div class="col-md-4">
      <h3>{{ $product_item->item_name }}</h3>
    </div>

    <div class="col-md-8">
      <table class="table">
        <thead>
          <tr>
            <th></th>
            @foreach( $mondays as $mons )
              <th>{{ $mons }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @foreach($itemPlanCharges as $charge)
            <?php
              $inNextMondayPlan = 0;
              $in2NextMondayPlan = 0;
              $in3NextMondayPlan = 0;
          
             // アイテム別、週別、担当者別の予定を算出
             for($i=0; $i<$product_item->charges_plan->count(); $i ++)
              {
                if($product_item->charges_plan[$i]->pivot->start_date_of_week == $mondays[0] and $product_item->charges_plan[$i]->pivot->charge_id == $charge->id)
                {
                  $num = $product_item->charges_plan[$i]->pivot->num;
                  $inNextMondayPlan = $inNextMondayPlan + $num;
                }elseif($product_item->charges_plan[$i]->pivot->start_date_of_week == $mondays[1] and $product_item->charges_plan[$i]->pivot->charge_id == $charge->id)
                {
                  $num = $product_item->charges_plan[$i]->pivot->num;
                  $in2NextMondayPlan = $in2NextMondayPlan + $num;
                }elseif($product_item->charges_plan[$i]->pivot->start_date_of_week == $mondays[2] and $product_item->charges_plan[$i]->pivot->charge_id == $charge->id)
                {
                  $num = $product_item->charges_plan[$i]->pivot->num;
                  $in3NextMondayPlan = $in3NextMondayPlan + $num;
                }
              }
              ?>
            <tr>
              <th>{{ $charge->charge_name }}</th>
              <td>{{ $inNextMondayPlan }}</td>
              <td>{{ $in2NextMondayPlan }}</td>
              <td>{{ $in3NextMondayPlan }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div class="d-flex justify-content-center">
        {{ $itemPlanCharges->links() }}
      </div>

      <form action="{{ route('production_plan_on_charge.store') }}" method="POST">
      @csrf
        <input type="hidden" name="product_item_id" value="{{ $product_item->id }}">
          <select name="charge_id">
            @foreach( $charges as $charge )
              <option value="{{ $charge->id }}">{{$charge->charge_name}}</option>
            @endforeach
          </select>
          <select name="start_date_of_week">
            @foreach( $mondays as $mons )
              <option value="{{ $mons }}">{{$mons}}</option>
            @endforeach
          </select>
        <input type="text" name="num" placeholder="例）100">
          <button type="submit" class="btn btn-primary">
            追加
          </button>
          @if ($errors->has('num'))
              <div class="text-danger">
                  {{ $errors->first('num') }}
              </div>
          @endif
      </form>
      
    </div>
  </div>
</div>
@endsection
