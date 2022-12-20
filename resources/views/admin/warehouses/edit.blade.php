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
            <h4>Omborni o'zgartirish</h4>
          </div>
        <div class="card-body">
          <div class="form-group">
            <label>Nomi</label>
            <input type="text" value="{{ $warehouse->name}}" name="name" class="form-control @error('name') is-invalid @enderror">
            @error('name')<div class="invalid-feedback">Oh no! this is invalid.</div>@enderror
          </div>
           <div class="form-group">
            <label>Magazin</label>
            <select name="shop_id" id="" class="form-control">
              <option>Select Shop</option>
              @foreach($shops as $shop)
              <option {{ $warehouse->shop_id==$shop->id ? 'selected' : '' }} value="{{ $shop->id }}">{{ $shop->name_uz }}</option>
              @endforeach
            </select>
          </div>
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Update</button>
          </div>
        </div>
      </div>
    </form>
    </div>

@endsection