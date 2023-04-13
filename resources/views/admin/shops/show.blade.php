@extends('layouts.admin')

@section('title')
    Do'kon
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      
        @csrf
      <div class="card">
          <div class="card-header">
            <h4>Do'kon</h4>
            <a href="{{ route('admin.shops.index')}}" class="btn btn-primary">Orqaga</a>
          </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>Nomi</th><td>{{ $shop->name_uz }}</td>
              </tr>
              <tr>
                <th>Admini</th><td>{{ $shop->admin }}</td>
              </tr>
              <tr>
                <th>Phone</th>
                <td>
                  {{ $shop->user->phone }}
                </td>
              </tr>
              <tr>
                <th>Qo'shilgan vaqti</th><td>{{ $shop->created_at }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>

    </div>

@endsection