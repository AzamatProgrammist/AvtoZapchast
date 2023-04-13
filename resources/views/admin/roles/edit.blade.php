@extends('layouts.admin')

@section('title')
    Update role
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      @can('edit role')
      <form method="POST" action="{{ route('admin.roles.update', $role->id)}}">
        @method('PUT')
        @csrf
      <div class="card">
          <div class="card-header">
            <h4>Update role</h4>
          </div>
        <div class="card-body">
          <div class="form-group">
            <label>Name</label>
            <input type="text" value="{{ $role->name }}" name="name" class="form-control">
          </div>
          <div class="section-title">Permissions</div>
            <div class="form-group">
              @foreach($permissions as $permission)
                <input @if(in_array($permission->id, $rolePermissions)) checked @endif type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                <span>{{ $permission->name }}</span> &nbsp &nbsp
              @endforeach
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