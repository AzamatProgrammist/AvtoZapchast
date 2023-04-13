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
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            @error('name') <span style="color: red;">{{ $message }} </span> @enderror
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
            @error('email') <span style="color: red;">{{ $message }} </span> @enderror
          </div>
          <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
            @error('phone') <span style="color: red;">{{ $message }} </span> @enderror
          </div>
          <div class="form-group">
            <label>Roles</label>
            <select name="roles[]" style="height: 100px;" class="form-control" multiple>
              @foreach($roles as $role)
              <option value="{{ $role->id }}">{{ $role->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
            @error('password') <span style="color: red;">{{ $message }} </span> @enderror
          </div>
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Save</button>
          </div>
        </div>
      </div>
    </form>
    </div>

@endsection