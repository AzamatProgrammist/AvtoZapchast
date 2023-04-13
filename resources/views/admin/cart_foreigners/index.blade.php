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
          <tbody><tr>
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
              @can('edit cart')
              <form action="{{ route('admin.carts_to_foreigners.update', $cart->id) }}" method="POST">
                @csrf
                @method('PUT')
                <td>{{ $loop->iteration}}</td>
                <td>{{ $cart->name }}</td>
                <td><input type="text" name="quantity[]" value="{{ $cart->quantity }}"></td>
                <td>{{ $cart->price }} $</td>
                <td>{{ $cart->model }}</td>
                <td>{{ $cart->quantity*$cart->price }} $</td>
                <td>  
                  <button type="submit" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></button>
              </form>
              @endcan
                  @can('delete cart')
                  <form style="display: inline;" method="POST" action="{{ route('admin.carts_to_foreigners.destroy', $cart->id)}}">
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
    @can('order Dubai')
    <form method="POST" action="{{ route('admin.orders_to_foreigners.store') }}">
        @csrf
        @foreach($carts as $cart)
          <input type="hidden" name="id[]" value="{{ $cart->id }}">
          <input type="hidden" name="product_id[]" value="{{ $cart->product_id }}">
        @endforeach
      <div align="right">
          <select name="shop_id">
              @foreach($shops as $shop)
                @if($shop->user->usertype == '1')
                  <option class="btn btn-success dropdown-toggle" value="{{ $shop->id }}">{{ $shop->name_uz }}</option>
                @endif
              @endforeach
          </select>

            <input type="hidden" name="full_price" value="{{ $full_price }}">
          <select name="status">
            <option class="btn btn-success dropdown-toggle" value="0">yangi</option>
            <option class="btn btn-success dropdown-toggle" value="1">To'landi</option>
          </select>

          <input type="submit" name="btn" class="btn btn-success" value="Buyurtma berish">
      </div>
    </form>
    @endcan
      </div>
    </div>

@endsection
