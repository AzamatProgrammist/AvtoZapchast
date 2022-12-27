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
                    <h4>Zakazlar</h4>
                    <div class="card-header-form">
                      <a href="{{ route('admin.carts.create') }}" class="btn btn-primary">Zakaz</a>
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
                      <table class="table table-bordered table-md">
                        <tbody><tr>
                          <th>#</th>
                          <th>Nomi</th>
                          <th>Magazinlar</th>
                          <th>Action</th>
                        </tr>
                        @foreach($orders as $order)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $order->name }}</td>
                          <td>{{ $order->shop->name_uz }}</td>
                          <td>
                            
                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-info">Edit</a>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary">View</a>
                            <form style="display: inline;" method="POST" action="{{ route('admin.orders.destroy', $order->id)}}">
                              @csrf
                              @method('DELETE')
                              <input class="btn btn-danger" onclick="return confirm('Confirm {{$order->name}} delete')" type="submit" value="Delete">
                            </form>
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