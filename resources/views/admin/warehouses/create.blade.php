@extends('layouts.admin')

@section('title')
    Create warehouse
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      <form method="POST" action="{{ route('admin.warehouses.store')}}">
        @csrf
      <div class="card">
          <div class="card-header">
            <h4>Ombor yaratish</h4>
          </div>
        <div class="card-body">
          <div class="form-group">
            <label>Ombor nomi</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
            @error('name')<div class="invalid-feedback">Oh no! This is invalid.</div>@enderror
          </div>
          <div class="form-group">
            <label>Shop</label>
            <select name="shop_id" id="" class="form-control">
              <option>Select Shop</option>
              @foreach($shops as $shop)
              <option value="{{ $shop->id }}">{{ $shop->name_uz }}</option>
              @endforeach
            </select>
          </div>
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Save</button>
          </div>
        </div>
      </div>
    </form>
    </div>

@endsection