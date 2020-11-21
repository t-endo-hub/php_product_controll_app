@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row">
    <table class="table">
        <thead>
          <tr>
            <th></th>
            @foreach($mons as $mon)
              <th>{{ $mon }}</th>
            @endforeach
            <th></th>
          </tr>
        </thead>
        <tbody>
        <td></td>
          @foreach($product_items as $product_item)
            <tr>
              <th>{{ $product_item->item_name }}</th>
             <?php
              $totalNum = 0;
              $inNextMondayNum = 0;
              $in2NextMondayNum = 0;
              $in3NextMondayNum = 0;

              for($i=0; $i<$product_item->charges_num->count(); $i ++)
              {
                if($product_item->charges_num[$i]->pivot->start_date_of_week == $mons[1])
                {
                  $num = $product_item->charges_num[$i]->pivot->num;
                  $inNextMondayNum = $inNextMondayNum + $num;
                }elseif($product_item->charges_num[$i]->pivot->start_date_of_week == $mons[2])
                {
                  $num = $product_item->charges_num[$i]->pivot->num;
                  $in2NextMondayNum = $in2NextMondayNum + $num;
                }elseif($product_item->charges_num[$i]->pivot->start_date_of_week == $mons[3])
                {
                  $num = $product_item->charges_num[$i]->pivot->num;
                  $in3NextMondayNum = $in3NextMondayNum + $num;
                }
              }
             ?>
             <td>生産実績</td>
             <td>{{ $inNextMondayNum }}</td>
             <td>{{ $in2NextMondayNum }}</td>
             <td>{{ $in3NextMondayNum }}</td>




              <td></td>
            </tr>
          @endforeach
         

              
              <td><a href="{{ route ('production_plan_on_charge.create', $product_items[0]->id) }}" class="btn btn-primary">生産予定数入力</a></td>
            </tr>
        </tbody>
    </table>
  </div>
</div>

@endsection