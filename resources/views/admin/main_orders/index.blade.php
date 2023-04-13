@extends('layouts.admin')

@section('title')
    Buyurtmalar
@endsection

@section('content')



    <div class="row">
      <div class="col-12">
        <div class="card">
           <div class="card-header">
            <h4>@lang('words.orders')</h4>
            <div class="card-header-form">
              @can('create cart')
              <a href="{{ route('admin.carts.create') }}" class="btn btn-primary">@lang('words.create')</a>
              @endcan
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
                  <tr>
                  <th>Numeric</th>
                  <th>Do'kon</th>
                  <th>Admin</th>
                  <th>Narxi</th>
                  <th>Status</th>
                </tr>
                </thead>

               <tbody>
                
                @foreach($main_orders as $main_order)
          @can('order shop')
          <form method="POST" action="{{ route('admin.main_orders.update', $main_order->id) }}">
                    @csrf
                    @method('PUT')
                <tr>
                  <td>
                    <a href="{{ route('admin.main_orders.show', $main_order->id)}}">
                      ORD-{{ $main_order->date }} - {{ $main_order->numeric }}
                    </a>
                  </td>
                  <td>{{ $main_order->shop_name }}</td>
                  <td>{{ $main_order->admin }}</td>
                  <td>{{ $main_order->full_price }} $</td>
                  <td>
                      @if($main_order->status == 0)
                        Yangi
                      @endif
                      @if($main_order->status == 1)
                        Bajarildi
                      @endif
                  </td>
                  
                </tr>
          </form>
          @endcan
               @endforeach
              </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>





@endsection