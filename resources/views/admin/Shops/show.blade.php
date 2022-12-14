@extends('layouts.admin')

@section('title')
    View category
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      
        @csrf
      <div class="card">
          <div class="card-header">
            <h4>category ID {{ $category->id }}</h4>
            <a href="{{ route('admin.categories.index')}}" class="btn btn-primary">Back</a>
          </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>Name UZ</th><td>{{ $category->name_uz }}</td>
              </tr>
              <tr>
                <th>Name RU</th><td>{{ $category->name_ru }}</td>
              </tr>
              <tr>
                <th>Slug</th><td>{{ $category->slug }}</td>
              </tr>
              <tr>
                <th>Created At</th><td>{{ $category->created_at }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>

    </div>

@endsection