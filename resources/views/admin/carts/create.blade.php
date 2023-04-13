@extends('layouts.admin')

@section('title')
    Tavarlar
@endsection
@section('content')




    <div class="row ">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Tavarlar</h4>
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
              <table class="table table-striped" id="table-1">
                  <thead>
                    <tr>
                    <th>#</th>
                    <th>Dubl/Org</th>
                    <th>Nomi</th>
                    <th>Marka</th>
                    <th>Brend</th>
                    <th>Part no'mer</th>
                    <th>Analog</th>
                    <th>Narxi</th>
                    <th>Model</th>
                    <th>O'lchami</th>
                    <th>Soni</th>
                    
                    <th>Action</th>
                  </tr>
                </thead>
                  <tbody>

                  @foreach($products as $product)
                 
                  <tr>
                    
                    <td>{{ $loop->iteration }}</td>
                    
                    <td>{{ $product->Org_Dub }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->markasi }}</td>
                    <td>{{ $product->brendi }}</td>
                    <td>{{ $product->part_number }}</td>
                    <td>{{ $product->analog }}</td>
                    <td>{{ $product->sotish_narxi }} $</td>
                    <td>{{ $product->model }}</td>
                    <td>{{ $product->size }}</td>
                    <td class="badge @if($product->soni<=25)
                      {{$status = 'badge-danger'}}
                    @elseif($product->soni>25 && $product->soni<=75)
                      {{$status = 'badge-warning'}}
                    @elseif($product->soni>75)
                      {{$status = 'badge-success'}}
                    @endif">{{ $product->soni }}</td>
                    <td>
                      @can('create cart')
                      <form action="{{ route('admin.carts.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="name" id="name" value="{{ $product->name }}">
                        <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="shop_id" id="shop_id" value="{{ $product->shop_id }}">
                        <input type="number" name="quantity" id="quantity" value="1" style="width: 70px;" min="1" required>
                        <button id="submit" type="submit" class="btn btn-info fas fa-save"></button>
                      </form>
                      @endcan
                    </td>
                  </tr>
                 @endforeach
                </tbody></table>
              </div>
              </div>
        
          </div>
        </div>      
    </div>


@endsection
