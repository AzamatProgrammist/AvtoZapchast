@extends('layouts.admin')

@section('title')
    Остатки
@endsection

@section('content')



    <div class="row">
      <div class="col-12">
        <div class="card">
           <div class="card-header">
            <h4>@lang('words.остатки')</h4>
            <div class="card-header-form">
              @can('create cart')
              <a href="{{ route('admin.carts.create') }}" class="btn btn-primary">@lang('words.create')</a>
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
            <div class="form-group">
            <div class="section-title">Select Shop</div>
                <form action="{{ route('admin.barcodes.select_shop')}}" method="POST">
                    @csrf
                    <select name="id" class="form-control select2">
                        @foreach($shops as $shop)
                        <option value="{{ $shop->id }}">{{ $shop->name_uz }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
              </div>
            <div class="table-responsive">
              <table class="table table-striped" id="bukabuka">
                <thead>
                  <tr>
                  <th>#</th>
                  <th>ОСТ</th>
                  <th>Count</th>
                  <th>Price</th>
                  <th>Action</th>
                </tr>
                </thead>

               <tbody>
                
                @foreach($astatkas as $astatka)
          @can('order shop')
          <form method="POST" action="">
                    @csrf
                    @method('PUT')
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                    <a href="{{ route('admin.astatka.show', $astatka->shop_id)}}">
                      OСТ-{{ $astatka->shop->name_uz }}
                    </a>
                  </td>
                  <td>{{ $astatka->soni }}</td>
                  <td>{{ $astatka->full_price }} $</td>
                  <td>
                    <a href="{{ route('admin.astatka.delete', $astatka->shop_id) }}" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></a>
                  </td>
                </tr>
          </form>
          @endcan
               @endforeach
              </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>





@endsection