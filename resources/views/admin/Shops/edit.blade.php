@extends('layouts.admin')

@section('title')
    Update shop
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      <form method="POST" action="{{ route('admin.shops.update', $shop->id)}}">
        @csrf
        @method('PUT')
      <div class="card">
          <div class="card-header">
            <h4>Update shop</h4>
          </div>
        <div class="card-body">
          <div class="form-group">
            <label>Name</label>
            <input type="text" value="{{ $shop->name_uz}}" name="name_uz" class="form-control @error('name_uz') is-invalid @enderror">
            @error('name_uz')<div class="invalid-feedback">Oh no! this is invalid.</div>@enderror
          </div>
          
           <div class="form-group">
            <label>Admin</label>
            <select name="user_id" id="" class="form-control">
              <option>Select Admin</option>
              @foreach($users as $user)
              <option {{ $shop->user_id==$user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>meta title</label>
            <input type="text" value="{{ $shop->meta_title}}" name="meta_title" class="form-control">
          </div>
          <div class="form-group">
            <label>Meta Description</label>
            <input type="text" value="{{ $shop->meta_description}}" name="meta_description" class="form-control">
          </div>
          <div class="form-group">
            <label>Meta Keyword</label>
            <input type="text" value="{{ $shop->meta_keywords}}" name="meta_keywords" class="form-control">
          </div>
  
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Update</button>
          </div>
        </div>
      </div>
    </form>
    </div>

@endsection