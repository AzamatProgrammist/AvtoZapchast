@extends('layouts.admin')

@section('title')
    Omborlar
@endsection

@section('content')


    <div class="row">
      <div class="col-12">
        <div class="card">
           <div class="card-header">
              <h4>@lang('words.warehouses')</h4>
                <div class="card-header-form">
                  @can('create ombor')
                  <a href="{{ route('admin.warehouses.create') }}" class="btn btn-primary">@lang('words.create')</a>
                  @endcan
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
              <table class="table table-striped" id="bukabuka">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nomi</th>
                    <th>Magazinlar</th>
                    <th>Admin</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                   @foreach($warehouses as $warehouse)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $warehouse->name }}</td>
                    <td>{{ $warehouse->shop->name_uz }}</td>
                    <td>{{ $warehouse->shop->user->name }}</td>
                    <td>{{ $warehouse->shop->user->phone }}</td>
                    <td>
                      <?php $status = 0 ?>
                      @foreach($warehouse->inkassas as $inkassa)
                        <?php  $status = $status + $inkassa->full_price  ?>
                      @endforeach
                      @if($status > 0)-{{ $status }}$ @endif
                    </td>
                    <td>
                      @can('edit ombor')
                      <a href="{{ route('admin.warehouses.edit', $warehouse->id) }}" class="btn btn-info far fa-edit"></a>
                      @endcan
                      <a href="{{ route('admin.warehouses.show', $warehouse->id) }}" class="btn btn-primary fas fa-eye"></a>
                      @can('delete ombor')
                      <form style="display: inline;" method="POST" action="{{ route('admin.warehouses.destroy', $warehouse->id)}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-icon btn-danger" onclick="return confirm('Confirm {{$warehouse->name}} delete')" type="submit"><i class="fas fa-times"></i></button>

                      </form>
                      @endcan
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
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