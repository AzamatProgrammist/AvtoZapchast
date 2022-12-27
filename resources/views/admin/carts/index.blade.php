@extends('layouts.admin')

@section('title')
    Buyurtma berish
@endsection

@section('content')

    <div class="row">
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
        <form method="POST" action="{{ route('admin.orders.store')}}">
          @csrf
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
          
            @foreach($carts as $cart)
            <tr>
              <form action="{{ route('admin.carts.update', $cart->id) }}" method="POST">
                @csrf
                @method('PUT')
                <td>{{ $loop->iteration}}</td>
                <td><input type="text" name="name" value="{{ $cart->name }}"></td>
                <td><input type="text" name="quantity[]" value="{{ $cart->quantity }}"></td>
                <td><input type="text" name="price" value="{{ $cart->price }} $"></td>
                <td><input type="text" name="model" value="{{ $cart->model }}"></td>
                <td><input type="text" name="full_price" value="{{ $cart->quantity*$cart->price }} $"></td>
                <td>  
                  <button type="submit" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></button>
              </form>

                  <form style="display: inline;" method="POST" action="{{ route('admin.carts.destroy', $cart->id)}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-icon btn-danger" onclick="return confirm('Confirm {{$cart->name}} delete')" type="submit"><i class="fas fa-times"></i></button>
                  </form>
                </td>
            </tr>
           @endforeach
        </tbody>
      </table>
      <div align="right">
          <select name="shop_id">
              @foreach($shops as $shop)
              <option class="btn btn-success dropdown-toggle" {{ $cart->shop_id==$shop->id ? 'selected' : '' }} value="{{ $shop->id }}">{{ $shop->name_uz }}</option>
              @endforeach
            </select>
          <input type="submit" name="" class="btn btn-success" value="Buyurtma berish">
      </div>
      </form>
      </div>
    </div>

@endsection