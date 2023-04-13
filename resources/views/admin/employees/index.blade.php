@extends('layouts.admin')

@section('title')
    Hodimlar
@endsection

@section('content')

    <div class="row">
      <div class="col-12 col-md-6 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>@lang('words.workers')</h4>
            <div class="card-header-form">
              <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">@lang('words.create')</a>
            </div>
            
          </div>
          @if(session('success'))
            <div class="alert alert-success alert-dismissible show fade col-lg-4">
              <div class="alert-body">
                <button class="close" data-dismiss="alert">
                  <span>×</span>
                </button>
                {{ session('success')}}
              </div>
            </div>
            @endif
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-md">
                <tbody><tr>
                  <th>#</th>
                  <th>Nomi</th>
                  <th>Kasbi</th>
                  <th>Warehouse</th>
                  <th>Phone</th>
                  <th>Action</th>
                </tr>
                @foreach($employees as $employee)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $employee->name }}</td>
                  <td>{{ $employee->job }}</td>
                  <td>{{ $employee->warehouse_name }}</td>
                  <td>{{ $employee->phone }}</td>
                  <td>
                    <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-info"><i class="far fa-edit"></i></a><!-- 
                    <a href="{{ route('admin.employees.show', $employee->id) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a> -->
                    <form style="display: inline;" method="POST" action="{{ route('admin.employees.destroy', $employee->id)}}">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-icon btn-danger" onclick="return confirm('Confirm {{$employee->name}} delete')" type="submit"><i class="fas fa-times"></i></button>
                    </form>
                  </td>
                </tr>
               @endforeach
              </tbody></table>
            </div>
            </div>
          <div class="card-footer text-right">
            <nav class="d-inline-block">
              <ul class="pagination mb-0">
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>

@endsection