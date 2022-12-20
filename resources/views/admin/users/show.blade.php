@extends('layouts.admin')

@section('title')
    View admin
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      
        @csrf
      <div class="card">
          <div class="card-header">
            <h4>Admin</h4>
            <a href="{{ route('admin.users.index')}}" class="btn btn-primary">Orqaga</a>
          </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>Ismi</th><td>{{ $user->name }}</td>
              </tr>
              <tr>
                <th>Phone</th><td>{{ $user->phone }}</td>
              </tr>
              <tr>
                <th>Email</th><td>{{ $user->email }}</td>
              </tr>
              @foreach($user->shops as $shops)
              <tr>
                <th>Shop</th><td>{{ $shops->name_uz }}</td>
              </tr>
              @endforeach
              <tr>
                <th>Created At</th><td>{{ $user->created_at }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>

    </div>

@endsection