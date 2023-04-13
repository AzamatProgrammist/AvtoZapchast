@extends('layouts.admin')

@section('title')
    Permissions
@endsection

@section('content')

<div class="row">
              <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>@lang('words.permissions')</h4>
                    @can('create permission')
                    <div class="card-header-form">
                    	<!-- <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">@lang('words.create')</a> -->
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
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                         <!--  <th>Action</th> -->
                        </tr>
                        @foreach($permissions as $permission)
                        <tr>
                          <td>{{ $loop->iteration}}</td>
                          <td>{{ $permission->name}}</td>
                         <!--  <td>
                          @can('edit permission')
                            <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-info">Edit</a>
                          @endcan
                            <a href="{{ route('admin.permissions.show', $permission->id) }}" class="btn btn-primary">View</a>
                          @can('delete permission')
                            <form style="display: inline;" method="POST" action="{{ route('admin.permissions.destroy', $permission->id)}}">
                              @csrf
                              @method('DELETE')
                              <input class="btn btn-danger" onclick="return confirm('Confirm {{$permission->name}} delete')" type="submit" value="Delete">
                            </form>
                          @endcan
                          </td> -->
                        </tr>
                       @endforeach
                      </table>
                    </div>
	                  </div>
                </div>
              </div>
            </div>

@endsection