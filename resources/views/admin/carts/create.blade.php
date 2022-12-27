@extends('layouts.admin')

@section('title')
    Tavarlar
@endsection
@section('content')

      <div class="row">
        @foreach($products as $product)
        <div class="col-12 col-md-6 col-lg-3">
          <div class="card card-primary">
            <div class="card-header">
              <h4>{{ $product->name }} {{ $product->sotish_narxi }}$</h4>
            </div>
            <div class="card-body">
              <img width="200" alt="image" src="/site/products/images/{{$product->image}}" class="img-fluid">
              <p>
                <form action="{{ route('admin.carts.store') }}" method="POST">
                  @csrf
                  <input type="hidden" name="name" id="name" value="{{ $product->name }}">
                  <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                  <input type="hidden" name="shop_id" id="shop_id" value="{{ $product->shop_id }}">
                  <input type="number" name="quantity" id="quantity" value="1" style="width: 80px;" min="1">
                  <button id="submit" type="submit" class="btn btn-outline-success">Add</button>
                  <code> 150 ta</code></p>
                </form>
            </div>
          </div>
        </div>
        @endforeach
      </div>


@endsection
