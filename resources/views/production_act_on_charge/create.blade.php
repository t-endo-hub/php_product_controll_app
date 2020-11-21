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
        <tr>
          <th></th>
          @foreach( $mondays as $mons )
            <th>{{ $mons }}</th>
          @endforeach
        </tr>

        @foreach($itemActCharges as $charge)
          <?php
            $lastMondayAct = 0;
            $in2NextMondayAct = 0;
            $in3NextMondayAct = 0;

            // アイテム別、週別の予定を算出
            for($i=0; $i<$charge->product_items_Act->count(); $i ++)
            {
              if($charge->pivot->start_date_of_week == $mondays[0])
              {
                $num = $charge->pivot->num;
                $lastMondayAct = $lastMondayAct + $num;
              }elseif($charge->pivot->start_date_of_week == $mondays[1])
              {
                $num = $charge->pivot->num;
                $in2NextMondayAct = $in2NextMondayAct + $num;
              }elseif($charge->pivot->start_date_of_week == $mondays[2])
              {
                $num = $charge->pivot->num;
                $in3NextMondayAct = $in3NextMondayAct + $num;
              }
            }
          ?>
          <tr>
            <th>{{ $charge->charge_name }}</th>
            <td>{{ $lastMondayAct }}</td>
            <td>{{ $in2NextMondayAct }}</td>
            <td>{{ $in3NextMondayAct }}</td>
          </tr>
        @endforeach
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
