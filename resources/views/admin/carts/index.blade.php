@extends('layouts.admin')

@section('title')
    Buyurtma berish
@endsection

@section('content')

    <div class="row">
                  @if(session('danger'))
                    <div class="alert alert-danger alert-dismissible show fade col-lg-4">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('success')}}
                      </div>
                    </div>
                    @endif
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible show fade col-lg-4">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('success')}}
                      </div>
                    </div>
                    @endif
    <div class="col-12 col-md-12 col-lg-12">
      <div class="table-responsive">

        <table class="table table-bordered table-md">
          <tbody>
            <tr>
              <th>T/R</th>
              <th>Nomi</th>
              <th>Soni</th>
              <th>Narxi</th>
              <th>Modeli</th>
              <th>Umumiy narxi</th>
              <th>Action</th>
            </tr>
          <?php 
                $full_price = 0;
          ?>
            @foreach($carts as $cart)
            <tr>
              <?php
                $full_price = $full_price + $cart->quantity*$cart->price 
              ?>
              <form action="{{ route('admin.carts.update', $cart->id) }}" method="POST">
                @csrf
                @method('PUT')
                <td>{{ $loop->iteration}}</td>
                <td>{{ $cart->name }}</td>
                <td><input type="text" name="quantity[]" value="{{ $cart->quantity }}"></td>
                <td>{{ $cart->price }} $</td>
                <td>{{ $cart->model }}</td>
                <td>{{ $cart->quantity*$cart->price }} $</td>
                <td>
                  @can('edit cart')
                  <button type="submit" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></button>
                  @endcan
              </form>
                  @can('delete cart')
                  <form style="display: inline;" method="POST" action="{{ route('admin.carts.destroy', $cart->id)}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-icon btn-danger" onclick="return confirm('Confirm {{$cart->name}} delete')" type="submit"><i class="fas fa-times"></i></button>
                  </form>
                  @endcan
                </td>
            </tr>
           @endforeach
           <tr>
             <td>Jami</td>
             <td>{{ $full_price }} $</td>
           </tr>
        </tbody>
      </table>
        <form method="POST" action="{{ route('admin.orders.store') }}">
            @csrf
            @foreach($carts as $cart)
              <input type="hidden" name="id[]" value="{{ $cart->id }}">
              <input type="hidden" name="product_id[]" value="{{ $cart->product_id }}">
            @endforeach
          <div align="right">
              <div class="col-12 col-md-6 col-lg-3">
                    <div class="form-group">
                      <label>Select shop</label>
                      <select class="form-control select2" name="shop_id">
                        @foreach($shops as $shop)
                          @if($shop->usertype == 0)
                            <option value="{{ $shop->id }}">{{ $shop->name_uz }}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Select warehouse</label>
                      <select class="form-control select2" name="warehouse_id">
                        @foreach($shops as $shop)
                          @if($shop->usertype == 0)

                            @foreach($shop->warehouses as $warehouse)

                              <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                              
                            @endforeach

                          @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                <input type="hidden" name="full_price" value="{{ $full_price }}">
                <input type="hidden" name="status" value="0">
                @can('order shop')
                <input type="submit" name="btn" class="btn btn-success" value="Buyurtma berish">
                @endcan
          </div>
        </form>
                  
      </div>
    </div>

@endsection
