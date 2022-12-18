@extends('layouts.admin')

@section('title')
    Update warehouse
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      <form method="POST" action="{{ route('admin.warehouses.update', $warehouse->id)}}">
        @csrf
        @method('PUT')
      <div class="card">
          <div class="card-header">
            <h4>Update warehouse</h4>
          </div>
        <div class="card-body">
          <div class="form-group">
            <label>Name</label>
            <input type="text" value="{{ $warehouse->name}}" name="name" class="form-control @error('name') is-invalid @enderror">
            @error('name')<div class="invalid-feedback">Oh no! this is invalid.</div>@enderror
          </div>
           <div class="form-group">
            <label>Shop</label>
            <select name="user_id" id="" class="form-control">
              <option>Select Shop</option>
              @foreach($shops as $shop)
              <option {{ $warehouse->shop_id==$shop->id ? 'selected' : '' }} value="{{ $shop->id }}">{{ $shop->name_uz }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>meta title</label>
            <input type="text" value="{{ $warehouse->meta_title}}" name="meta_title" class="form-control">
          </div>
          <div class="form-group">
            <label>Meta Description</label>
            <input type="text" value="{{ $warehouse->meta_description}}" name="meta_description" class="form-control">
          </div>
          <div class="form-group">
            <label>Meta Keyword</label>
            <input type="text" value="{{ $warehouse->meta_keywords}}" name="meta_keywords" class="form-control">
          </div>
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Update</button>
          </div>
        </div>
      </div>
    </form>
    </div>

@endsection