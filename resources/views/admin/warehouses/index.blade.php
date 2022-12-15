@extends('layouts.admin')

@section('title')
    Warehouses
@endsection

@section('content')

<div class="row">
              <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Warehouses</h4>
                    <div class="card-header-form">
                      <a href="{{ route('admin.warehouses.create') }}" class="btn btn-primary">Create</a>
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
                          <th>Name</th>
                          <th>Shops</th>
                          <th>Action</th>
                        </tr>
                        @foreach($warehouses as $warehouse)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $warehouse->name }}</td>
                          <td>{{ $warehouse->shop_id }}</td>
                          <td>
                            
                            <a href="{{ route('admin.warehouses.edit', $warehouse->id) }}" class="btn btn-info">Edit</a>
                            <a href="{{ route('admin.warehouses.show', $warehouse->id) }}" class="btn btn-primary">View</a>
                            <form style="display: inline;" method="POST" action="{{ route('admin.warehouses.destroy', $warehouse->id)}}">
                              @csrf
                              @method('DELETE')
                              <input class="btn btn-danger" onclick="return confirm('Confirm {{$warehouse->name}} delete')" type="submit" value="Delete">
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
                        {{ $warehouses->links() }}
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>

            </div>

@endsection