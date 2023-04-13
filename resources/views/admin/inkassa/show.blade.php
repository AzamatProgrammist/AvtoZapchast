@extends('layouts.admin')

@section('title')
    Buyurtmalar
@endsection

@section('content')

    <div class="row">
      <div class="col-12">
        <div class="card">
           <div class="card-header">
            <h4>Kirim chiqimlar</h4>
            <!-- <div class="card-header-form">
              <a href="{{ route('admin.carts.create') }}" class="btn btn-primary">Zakaz</a>
            </div> -->
            <div class="card-body">
                    
                <div class="dropdown d-inline mr-2">
                  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton3"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Magazinlar
                  </button>
                  <div class="dropdown-menu">
                   @foreach($shop_name as $inkassa)
                    <a class="dropdown-item" href="{{ route('admin.shops.inkassa', $inkassa->id) }}">{{ $inkassa->name_uz }}</a>
                    @endforeach
                  </div>
                </div>
                
              </div>
          </div>
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
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="table-1">
                <thead>
                  
                </thead>
            @foreach($shopShow->inkassas as $inkassa)
               <tbody>
              @can('order shop')
              <form method="POST" action="{{ route('admin.main_orders.update', $inkassa->id) }}">
                    @csrf
                    @method('PUT')
                <tr>
                  <td>
                    <a href="{{ route('admin.main_orders.show', $inkassa->mainOrder_id)}}">
                      ORD-{{ $inkassa->date }} - {{ $inkassa->numeric }}
                    </a>
                  </td>
                  <td>- {{ $inkassa->full_price }} $</td>
                </tr>
              </form>
              @endcan
                <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>Soni</th>
                  <th>Summasi</th>
                  <th>Action</th>
                </tr>
                @foreach($inkassa->inkassaSubs as $inkassaSub)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $inkassaSub->name }}</td>
                  <td>{{ $inkassaSub->soni }}</td>
                  <td>{{ $inkassaSub->full_price }}</td>
                  <td>
                    @can('crud inkassa')
                     <form action="{{ route('admin.inkassa.update', $inkassa->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="soni" id="soni" value="{{ $inkassaSub->soni }}">
                        <input type="hidden" name="product_id" id="product_id" value="{{ $inkassaSub->product_id }}">
                        <input type="hidden" name="id" id="id" value="{{ $inkassaSub->id }}">
                        <input type="hidden" name="shop_id" id="shop_id" value="{{ $inkassaSub->shop_id }}">

                        <input type="number" name="quantity" id="quantity" style="width: 70px;" min="1" required>

                        <button id="submit" type="submit" class="btn btn-info fas fa-save"></button>
                    </form>
                    @endcan
                  </td>
                </tr>
                @endforeach
              </tbody>
            @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>





@endsection