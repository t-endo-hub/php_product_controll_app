<div class="container">
  <div class="row">
    <h3>生産アイテム新規登録</h3>
    <form action="{{route('product_item.store')}}" method="POST">
      @csrf
      <div>
        <label>アイテム名</label><br>
        <input type="text" name="name" />
        <button type="submit" class="btn btn-primary">
          追加
        </button>
      </div>
    </form>

  </div>
</div>