@extends('layouts.admin')

@section('title')
    Hodim yaratish
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      <form method="POST" action="{{ route('admin.employees.store')}}">
        @csrf
      <div class="card">
          <div class="card-header">
            <h4>Magazin yaratish</h4>
          </div>
        <div class="card-body">
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
            @error('name')<span style="color: red;">{{ $message }} </span>@enderror
          </div>
          <div class="form-group">
            <label>Kasbi</label>
            <input type="text" name="job" class="form-control @error('job') is-invalid @enderror">
            @error('job')<span style="color: red;">{{ $message }} </span>@enderror
          </div>
          <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror">
            @error('phone')<span>{{ $message }}</span>@enderror
          </div>
          <div class="form-group">
            <label>Do'kon</label>
            <select name="shopid" id="" class="form-control">
              @foreach($warehouses as $warehouse)
              <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
              @endforeach
            </select>
             @error('shopid')<span>{{ $message }}</span>@enderror
          </div>
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Save</button>
          </div>
        </div>
      </div>
    </form>
    </div>

@endsection