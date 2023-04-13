@extends('layouts.admin')

@section('title')
    Update permission
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      @can('edit permission')
      <form method="POST" action="{{ route('admin.permissions.update', $permission->id)}}">
        @method('PUT')
        @csrf
      <div class="card">
          <div class="card-header">
            <h4>Update permission</h4>
          </div>
        <div class="card-body">
          <div class="form-group">
            <label>Name</label>
            <input type="text" value="{{ $permission->name }}" name="name" class="form-control">
          </div>
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Save</button>
          </div>
        </div>
      </div>
    </form>
    @endcan
  </div>

@endsection