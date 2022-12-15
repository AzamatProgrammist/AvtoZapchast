@extends('layouts.admin')

@section('title')
    Users
@endsection

@section('content')

<div class="row">
              <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Users</h4>
                    <div class="card-header-form">
                    	<a href="{{ route('admin.users.create') }}" class="btn btn-primary">Create</a>
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
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Action</th>
                        </tr>
                        @foreach($users as $user)
                        <tr>
                          <td>{{ $loop->iteration}}</td>
                          <td>{{ $user->name}}</td>
                          <td>{{ $user->email}}</td>
                          <td>{{ $user->phone}}</td>
                          <td>
                            
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info">Edit</a>
                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-primary">View</a>
                            <form style="display: inline;" method="POST" action="{{ route('admin.users.destroy', $user->id)}}">
                              @csrf
                              @method('DELETE')
                              <input class="btn btn-danger" onclick="return confirm('Confirm {{$user->name}} delete')" type="submit" value="Delete">
                            </form>
                          </td>
                        </tr>
                       @endforeach
                      </tbody></table>
                    </div>
	                  </div>
                </div>
              </div>

            </div>

@endsection