@extends('layouts.admin')

@section('title')
    Ombor
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      
        @csrf
      <div class="card">
          <div class="card-header">
            <h4>Ombor {{ $warehouse->name }}</h4>
            <a href="{{ route('admin.warehouses.index')}}" class="btn btn-primary">Orqaga</a>
          </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>Nomi</th><td>{{ $warehouse->name }}</td>
              </tr>
              <tr>
                <th>Magazin</th><td>{{ $warehouse->shop->name_uz }}</td>
              </tr>
              <tr>
                <th>Qo'shilgan vaqti</th><td>{{ $warehouse->created_at }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>

    </div>

@endsection