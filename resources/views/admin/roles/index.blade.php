@extends('layouts.admin')

@section('title')
    Roles
@endsection

@section('content')

            <div class="row">
              <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>@lang('words.roles')</h4>
                    @can('create role')
                    <div class="card-header-form">
                    	<a href="{{ route('admin.roles.create') }}" class="btn btn-primary">@lang('words.create')</a>
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
                          <!-- <th>Permissions</th> -->
                          <th>Action</th>
                        </tr>
                        @foreach($roles as $role)
                        <tr>
                          <td>{{ $loop->iteration}}</td>
                          <td>{{ $role->name}}</td>
                         <!--  <td>
                            @foreach($role->permissions as $permission)
                              {{ $permission->name }},
                            @endforeach
                          </td> -->
                          <td>
                            @can('edit role')
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-info">Edit</a>
                            @endcan
                            <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-primary">View</a>
                            @can('delete role')
                            <form style="display: inline;" method="POST" action="{{ route('admin.roles.destroy', $role->id)}}">
                              @csrf
                              @method('DELETE')
                              <input class="btn btn-danger" onclick="return confirm('Confirm {{$role->name}} delete')" type="submit" value="Delete">
                            </form>
                            @endcan
                          </td>
                        </tr>
                       @endforeach
                      </table>
                    </div>
	                  </div>
                </div>
              </div>
            </div>

@endsection