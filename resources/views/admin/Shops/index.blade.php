@extends('layouts.admin')

@section('title')
    Do'konlar
@endsection

@section('content')


    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>@lang('words.shops')</h4>
             <div class="card-header-form">
              @can('create shop')
              <a href="{{ route('admin.shops.create') }}" class="btn btn-primary">@lang('words.create')</a>
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
                    <th class="text-center">
                      #
                    </th>
                    <th>Nomi</th>
                    <th>Admini</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($shops as $shop)
                  <tr>
                    <td>
                      {{ $loop->iteration }}
                    </td>
                    <td>{{ $shop->name_uz }}</td>
                    <td>{{ $shop->admin }}</td>
                    <td>
                       <?php $status = 0 ?>
                        @foreach($shop->inkassas as $inkassa)
                          <?php  $status = $status + $inkassa->full_price  ?>
                        @endforeach

                      <a href="{{ route('admin.shops.status', $shop->id) }}" class="badge badge-warning">@if($status > 0)-{{ $status }}$ @endif</a>
                        
                    </td>
                    <td>
                      @can('edit shop')
                      <a href="{{ route('admin.shops.edit', $shop->id) }}" class="btn btn-info far fa-edit"></a>
                      @endcan
                      <a href="{{ route('admin.shops.show', $shop->id) }}" class="btn btn-primary fas fa-eye"></a>
                      @can('delete shop')
                      <form style="display: inline;" method="POST" action="{{ route('admin.shops.destroy', $shop->id)}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-icon btn-danger" onclick="return confirm('Confirm {{$shop->name_uz}} delete')" type="submit"><i class="fas fa-times"></i></button>
                      </form>
                      @endcan
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection