@extends('layouts.admin')

@section('title')
    Buyurtmalar
@endsection

@section('content')



    <div class="row">
      <div class="col-12">
        <div class="card">
           <div class="card-header">
            <h4>Buyurtmalar</h4>
            @can('create cart')
            <div class="card-header-form">
              <a href="{{ route('admin.carts.create') }}" class="btn btn-primary">@lang('words.create')</a>
            </div>
            @endcan
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
                  <tr>
                  <th>Numeric</th>
                  <th>Do'kon</th>
                  <th>Admin</th>
                  <th>Narxi</th>
                  <th>Status</th>
                  @can('crud inkassa')
                  <th>To'lash</th>
                  @endcan
                </tr>
                </thead>

               <tbody>
                
                @foreach($orders as $order)
          
          <form method="POST" action="{{ route('admin.main_orders.update', $order->id) }}">
                    @csrf
                    @method('PUT')
                <tr>
                  <td>
                    <a href="{{ route('admin.main_orders.show', $order->id)}}">
                      ORD-{{ $order->date }} - {{ $order->numeric }}
                    </a>
                  </td>
                  <td>{{ $order->shop_name }}</td>
                  <td>{{ $order->admin }}</td>
                  @if($order->status == 1)
                  <td><DEL>-{{ $order->full_price }} $</DEL></td>
                  @endif
                  @if($order->status == 0)
                   @if($order->status == 0)
                        @foreach($inkassas as $inkassa)
                          @if($inkassa->mainOrder_id == $order->id)
                            <td>-{{ $inkassa->full_price }} $</td>
                          @endif
                        @endforeach
                      @endif
                  
                  @endif
                  <td>
                    @if($order->status == 0)
                        <a href="#" class="btn btn-icon btn-warning"><i class="fas fa-exclamation-triangle"></i></a>
                      @endif
                      @if($order->status == 1)
                        <a href="#" class="btn btn-icon btn-success"><i class="fas fa-check"></i></a>
                      @endif
                  </td>
                    @can('crud inkassa')
                  <td>
                      @if($order->status == 0)
                        @foreach($inkassas as $inkassa)
                          @if($inkassa->mainOrder_id == $order->id)
                            <a class="dropdown-item" href="{{ route('admin.inkassa.show', $inkassa->id) }}">To'lash</a>
                          @endif
                        @endforeach
                      @endif
                  </td>
                      @endcan
                </tr>
                  </form>
               @endforeach
              </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>





@endsection