@extends('layouts.app')
@section('content')

<div class="container">
    <h2>担当者新規登録</h2>
    <form action="{{route('charge.store')}}" method="POST">
    @csrf
      <div>
        <label>担当者名</label><br>
        <input type="text" name="charge_name" />
        <button type="submit" class="btn btn-primary">
          追加
        </button>

        @if ($errors->has('item_name'))
            <div class="text-danger">
                {{ $errors->first('item_name') }}
            </div>
        @endif

      </div>
    </form>
</div>
@endsection
