@extends('layouts.admin')

@section('title')
    Update Employee
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      <form method="POST" action="{{ route('admin.employees.update', $employee->id)}}">
        @csrf
        @method('PUT')
      <div class="card">
          <div class="card-header">
            <h4>Employee edited</h4>
          </div>
        <div class="card-body">
          <div class="form-group">
            <label>Name</label>
            <input type="text" value="{{ $employee->name}}" name="name" class="form-control @error('name') is-invalid @enderror">
            @error('name')<span style="color: red;">{{ $message }} </span>@enderror
          </div>
          
          <div class="form-group">
            <label>Kasbi</label>
            <input type="text" value="{{ $employee->job }}" name="job" class="form-control">
          </div>
          <div class="form-group">
            <label>Phone</label>
            <input type="text" value="{{ $employee->phone }}" name="phone" class="form-control">
          </div>
           <div class="form-group">
            <label>Warehouses</label>
            <select name="shopid" id="" class="form-control">
              @foreach($warehouses as $warehouse)
              <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
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