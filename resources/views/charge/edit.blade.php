@extends('layouts.app')
@section('content')

<div class="container">
  <h2>担当者編集</h2>
  <div class="row mt-4">
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

    <form action="{{ route ('charge.destroy', $charge->id) }}" method="POST">
    @method('DELETE')
    @csrf
      <button type="submit" class="btn btn-danger">削除</button>
    </form>
  </div>
</div>
@endsection
