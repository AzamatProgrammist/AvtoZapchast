@extends('layouts.admin')

@section('title')
    Zakazlar
@endsection

@section('content')


    <div class="row">
              <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <div class="card-header">
                    <h4>@lang('words.orders')</h4>
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
                      <table class="table table-bordered table-md">
                        <tbody><tr>
                          <th>#</th>
                          <th>Nomi</th>
                          <th>Rasmi</th>
                          <th>Magazinlar</th>
                          <th>Soni</th>
                          <th>Narxi</th>
                          <th>Umumiy narxi</th>
                          <th>Action</th>
                        </tr>
                        @foreach($orders as $order)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $order->name }}</td>
                          <td>
                            <img width="40" src="/site/products/images/{{$order->image}}">
                          </td>
                          <td>{{ $order->shop->name_uz }}</td>
                          <td>{{ $order->created_at }}</td>
                          <td>{{ $order->sotish_narxi }}</td>
                          <td>{{ $order->full_price }}</td>

                          <td>
                          @can('order shop')
                            <form style="display: inline;" method="POST" action="{{ route('admin.orders.destroy', $order->id)}}">
                              @csrf
                              @method('DELETE')

                              <button class="btn btn-icon btn-danger" onclick="return confirm('Confirm {{$order->name}} delete')" type="submit"><i class="fas fa-times"></i></button>
                            </form>
                          @endcan
                          </td>
                        </tr>
                       @endforeach
                      </tbody></table>
                    </div>
                    </div>
                  <div class="card-footer text-right">
                    <nav class="d-inline-block">
                      <ul class="pagination mb-0">
                        {{ $orders->links() }}
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>

            </div>




@endsection