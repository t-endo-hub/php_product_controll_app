@extends('layouts.app')
@section('content')

<div class="container">
  <h2>実績登録</h2>
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
          @foreach($itemActCharges as $charge)
            <tr>
              <th>{{ $charge->charge_name }}</th>
              <?php
                $lastMondayAct = 0;
                $inNextMondayAct = 0;
                $in2NextMondayAct = 0;
                $in3NextMondayAct = 0;
                // アイテム別、週別の実績を算出
                for($i=0; $i<$product_item->charges_act->count(); $i ++)
                {
                  if($product_item->charges_act[$i]->pivot->start_date_of_week == $mondays[0] and $product_item->charges_act[$i]->pivot->charge_id == $charge->id)
                  {
                    $num = $product_item->charges_act[$i]->pivot->num;
                    $lastMondayAct = $lastMondayAct + $num;
                  }elseif($product_item->charges_act[$i]->pivot->start_date_of_week == $mondays[1] and $product_item->charges_act[$i]->pivot->charge_id == $charge->id)
                  {
                    $num = $product_item->charges_act[$i]->pivot->num;
                    $inNextMondayAct = $inNextMondayAct + $num;
                  }elseif($product_item->charges_act[$i]->pivot->start_date_of_week == $mondays[2] and $product_item->charges_act[$i]->pivot->charge_id == $charge->id)
                  {
                    $num = $product_item->charges_act[$i]->pivot->num;
                    $in2NextMondayAct = $in2NextMondayAct + $num;
                  }elseif($product_item->charges_act[$i]->pivot->start_date_of_week == $mondays[3] and $product_item->charges_act[$i]->pivot->charge_id == $charge->id)
                  {
                    $num = $product_item->charges_act[$i]->pivot->num;
                    $in3NextMondayAct = $in3NextMondayAct + $num;
                  }
                }
              ?>
              <td>{{ $lastMondayAct }}</td>
              <td>{{ $inNextMondayAct }}</td>
              <td>{{ $in2NextMondayAct }}</td>
              <td>{{ $in3NextMondayAct }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div class="d-flex justify-content-center">
        {{ $itemActCharges->links() }}
      </div>

      <form action="{{ route('production_act_on_charge.store') }}" method="POST">
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
        <input type="text" name="num" placeholder="最大1000">
        
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
