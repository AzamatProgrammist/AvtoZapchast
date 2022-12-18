@extends('layouts.admin')

@section('title')
    Shops
@endsection

@section('content')

    <div class="row">
      <div class="col-12 col-md-6 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Shops</h4>
            <div class="card-header-form">
              <a href="{{ route('admin.shops.create') }}" class="btn btn-primary">Create</a>
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
                  <th>Admin</th>
                  <th>Action</th>
                </tr>
                @foreach($shops as $shop)
                <tr>
                  <td>{{ $loop->iteration}}</td>
                  <td>{{ $shop->name_uz}}</td>
                  <td>{{ $shop->admin}}</td>
                  <td>
                    
                    <a href="{{ route('admin.shops.edit', $shop->id) }}" class="btn btn-info">Edit</a>
                    <a href="{{ route('admin.shops.show', $shop->id) }}" class="btn btn-primary">View</a>
                    <form style="display: inline;" method="POST" action="{{ route('admin.shops.destroy', $shop->id)}}">
                      @csrf
                      @method('DELETE')
                      <input class="btn btn-danger" onclick="return confirm('Confirm {{$shop->name_uz}} delete')" type="submit" value="Delete">
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
                {{ $shops->links() }}
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>

@endsection