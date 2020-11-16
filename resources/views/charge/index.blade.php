@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row mb-2">
    <h2>担当者一覧</h2>
    <a class="btn btn-primary ml-3" href="{{ route('charge.create') }}">
        新規担当者追加
    </a>
    </div>
  <div class="row">
    <table class="table">
      <tr>
        <th>担当者名</th>
        <th>対応可能アイテム数</th>
        <th></th>
      </tr>
      @foreach($charges as $charge)
      <tr>
        <td>{{$charge->charge_name}}</td>
        <td>対応可能アイテム数</td>
        <td>
          <a class="btn btn-primary" href="{{ route ('charge_can_work.create', $charge->id) }}" >対応可能アイテム追加</a>
          <a class="btn btn-primary" href="{{ route ('charge.edit', $charge->id) }}" >詳細</a>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
  <div class="d-flex justify-content-center">
    {{ $charges->links() }}
  </div>
</div>

@endsection
