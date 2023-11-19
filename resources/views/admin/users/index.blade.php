@extends('layouts.admin')

@section('title')
    Adminlar
@endsection

@section('content')



    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>@lang('words.admins')</h4>
            @can('create admin')
            <div class="card-header-form">
              <a href="{{ route('admin.users.create') }}" class="btn btn-primary">@lang('words.create')</a>
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
              <table class="table table-striped" id="bukabuka">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nomi</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Roles</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                  <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $user->name}}</td>
                    <td>{{ $user->email}}</td>
                    <td>{{ $user->phone}}</td>
                    <td>
                      @foreach($user->roles as $role)
                        {{ $role->name }}, 
                      @endforeach
                    </td>
                    <td>
                    @can('edit admin')   
                      <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info far fa-edit"></a>
                    @endcan
                      <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-primary fas fa-eye"></a>
                    @can('delete admin')
                      <form style="display: inline;" method="POST" action="{{ route('admin.users.destroy', $user->id)}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-icon btn-danger" onclick="return confirm('Confirm {{$user->name}} delete')" type="submit"><i class="fas fa-times"></i></button>
                      </form>
                    @endcan
                    </td>
                  </tr>
                 @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection