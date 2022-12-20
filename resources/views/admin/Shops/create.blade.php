@extends('layouts.admin')

@section('title')
    Magazin yaratish
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      <form method="POST" action="{{ route('admin.shops.store')}}">
        @csrf
      <div class="card">
          <div class="card-header">
            <h4>Magazin yaratish</h4>
          </div>
        <div class="card-body">
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name_uz" class="form-control @error('name_uz') is-invalid @enderror">
            @error('name_uz')<div class="invalid-feedback">Oh no! This is invalid.</div>@enderror
          </div>
          <div class="form-group">
            <label>Admin</label>
            <select name="user_id" id="" class="form-control">
              <option>Select Admin</option>
              @foreach($users as $user)
              <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Meta title</label>
            <input type="text" name="meta_title" class="form-control">
          </div>
          <div class="form-group">
            <label>Meta Description</label>
            <input type="text" name="meta_description" class="form-control">
          </div>
          <div class="form-group">
            <label>Meta keywords</label>
            <input type="text" name="meta_keywords" class="form-control">
          </div>
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Save</button>
          </div>
        </div>
      </div>
    </form>
    </div>

@endsection