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
            @can('create cart')
            <div class="card-header-form">
              <a href="{{ route('admin.carts_to_foreigners.create') }}" class="btn btn-primary">@lang('words.create')</a>
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
              <table class="table table-striped" id="bukabuka">
                <thead>
                  <tr>
                  <th>Numeric</th>
                  <th>Do'kon</th>
                  <th>Admin</th>
                  <th>yil</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>

               <tbody>
                
                @foreach($orders_to_foreigners as $orders_to_foreigner)
          @can('order Dubai')
          <form method="POST" action="{{ route('admin.orders_to_foreigners.update', $orders_to_foreigner->id) }}">
                    @csrf
                    @method('PUT')
                <tr>
                  <td>
                    <a href="{{ route('admin.mainOrderForeigner.show', $orders_to_foreigner->id)}}">
                      ORD-{{ $orders_to_foreigner->date }} - {{ $orders_to_foreigner->numeric }}
                    </a>
                  </td>
                  <td>{{ $orders_to_foreigner->shop_name }}</td>
                  <td>{{ $orders_to_foreigner->admin }}</td>
                  <td>{{ $orders_to_foreigner->date }} </td>
                  <td>
                    {{\Carbon\Carbon::parse($orders_to_foreigner->created_at)->format('d M y')}}
                  </td>
                  <td>
                  <button type="submit" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></button>
                    
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