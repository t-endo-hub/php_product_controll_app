@extends('layouts.app')
@section('content')

{{ @$hoges }}

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
          @foreach($product_items as $product_item)
            <tr>
              <th>{{ $product_item->item_name }}</th>
              <td>生産実績</td>

              <td>{{ $totalNextMondayNum }}</td>
              <td><a href="{{ route ('production_plan_on_charge.create', $product_item->id) }}" class="btn btn-primary">生産予定数入力</a></td>
            </tr>
          @endforeach
        </tbody>
    </table>
  </div>
</div>

@endsection