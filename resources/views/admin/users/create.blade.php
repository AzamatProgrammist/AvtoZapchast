@extends('layouts.admin')

@section('title')
    Create admin
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
      <div class="card">
          <div class="card-header">
            <h4>Admin yaratish</h4>
          </div>
        <div class="card-body">
          <div class="form-group">
            <label>Ismi</label>
            <input type="text" name="name" class="form-control">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
          </div>
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Save</button>
          </div>
        </div>
      </div>
    </form>
    </div>

@endsection