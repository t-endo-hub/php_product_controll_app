@extends('layouts.app')
@section('content')

<div class="container">
  <h2>予定編集</h2>
  <div class="row">
    <div class="col-md-3">
      <h3>{{ $product_item->item_name }}</h3>
      <h4>{{ $charge->charge_name }}</h4>
    </div>

    <div class="col-md-9">
    <!-- $alredyPlanは1つのみのはずなので[0]でOK? -->
      <form action="{{ route ('production_plan_on_charge.update', $alredyPlan[0]->id)}}" method="POST">
      @method('PATCH')
      @csrf
        <table class="table">
          <thead>
            <th>{{ $week }}</th>
          </thead>
          <tbody>
            <td><input type="text" name="num" value="{{ $alredyPlan[0]->num }}"></td>
          </tbody>
        </table>
        <button type="submit" class="btn btn-primary">
          更新
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
