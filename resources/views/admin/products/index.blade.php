@extends('layouts.admin')

@section('title')
    @lang('words.products')
@endsection

@section('content')


    <div class="row ">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>@lang('words.products')</h4>
              <div class="card-header-form">
              @can('create product')
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">@lang('words.create')</a>
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
                <table
                          class="table table-striped table-hover"
                          id="bukabuka"
                          style="width: 100%"
                        >
                  <thead>
                    <tr>
                      <!-- <th>#</th> -->
                      <th>Dubl/Org</th>
                      <th>Nomi</th>
                      <th>Model/Marka/Yili</th>
                      <th>Brend</th>
                      <th>Narxi</th>
                      <th>Soni</th>
                      @role('Adminstrator')
                        <th>kelgan vaqti</th>
                      @endrole
                      <th>Analog</th>
                      <th>Rasmi</th>
                      <th>Barcode</th>
                      <th>Image_path</th>
                      <th>Part no'mer</th>
                      @role('Adminstrator')
                        <th>Olingan narx</th>
                        <th>yuk narxi</th>
                        <th>Kg</th>
                      @endrole
                      @role('Adminstrator')
                        <th>To'liq narx</th>
                      @endrole
                      <th>O'lchami</th>
                      @can('edit product')
                        <th>edit</th>
                        <th>view</th>
                      @endcan
                      @can('delete product')
                      <th>delete</th>
                      @endcan
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($sorts as $sort)
                  @foreach($products as $product)
                  @if($sort == $product->analog)
                  <tr>
                    
                    <!-- <td>{{ $loop->iteration }}</td> -->
                    <td>{{ $product->Org_Dub }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->model }}/{{ $product->markasi }}/{{ $product->chiqqan_yili }}</td>
                    <td>{{ $product->brendi }}</td>
                    <td>{{ $product->sotish_narxi }} $</td>
                    <td class="badge @if($product->soni<=$product->little)
                      {{$status = 'badge-danger'}}
                    @elseif($product->soni>$product->little && $product->soni<=$product->many)
                      {{$status = 'badge-warning'}}
                    @elseif($product->soni>$product->many)
                      {{$status = 'badge-success'}}
                    @endif">
                    
                  
                    <section class="section"> 
                      <a class="" type="button" id="dropdownMenuButton3"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ $product->soni }}
                      </a>
                            <div class="dropdown-menu">

                              <?php $inkassaSub_num = 0; ?>
                              
                              @foreach($shops as $shop)
                                <?php $num = 0; ?>
                                @if($shop->user)
                                  @foreach($product->inkassaSubs as $inkassaSub)
                                    
                                    @if($inkassaSub->shop_id == $shop->id)
                                      <?php 
                                        $num = $num + $inkassaSub->soni; 
                                        $inkassaSub_num = $inkassaSub_num + $inkassaSub->soni;
                                      ?>
                                    @endif
                                  @endforeach

                                  @if($num > 0)
                                      <a class="dropdown-item" href="#">{{ $shop->name_uz }} {{ $num }} ta</a>
                                  @endif
                                  
                                @endif
                              @endforeach

                              @foreach($shops as $shop)
                                @if($shop->user)
                                @if($shop->user->usertype == 1)
                                    @if($shop->id == $product->shop_id)
                                      <a class="dropdown-item" href="#">{{ $shop->name_uz }} {{ $product->soni - $inkassaSub_num }} ta</a>
                                    @endif
                                  @endif
                                @endif
                              @endforeach
                                      <a class="dropdown-item" href="#">skladda {{ $product->soni - $inkassaSub_num }} ta</a>
                            </div>
                    </section>

                  </td>
                    @role('Adminstrator')
                      <td>{{ $product->kelgan_yili }}</td>
                    @endrole
                    <td>{{ $product->analog }}</td>
                    <td>
                      <img width="40" src="/site/products/images/{{ $product->image }}">
                    </td>

                  <?php if ($product->barcode === '' || $product->barcode == null) { ?>
                    <td>
                      <form action="{{ route('admin.barcodes.generate') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="submit" name="generate_barcode" value="generate" class="btn btn-success">
                      </form>
                    </td>
                  <?php } else { ?>
                    <td>{{ $product->barcode }}</td>
                  <?php } ?>
                    @if($product->image_path == NULL || $product->image_path == '')
                      <td>No Barceode</td>
                    @else
                      <td>
                         <img width="100" src="{{ Storage::url($product->image_path) }}">
                      </td>
                    @endif

                    <td>{{ $product->part_number }}</td>
                    @role('Adminstrator')
                      <td>{{ $product->olingan_narxi }} $</td>
                      <td>{{ $product->yuk_narxi }} $</td>
                    
                    <td>{{ $product->weight }}</td>
                    
                      <td>{{ $product->full_price }} $</td>
                    @endrole
                    <td>{{ $product->size }}</td>
                    @can('edit product')
                      <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-info far fa-edit"></a>
                        
                      </td>
                      <td>
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-primary fas fa-eye"></a>
                        
                      </td>
                    @endcan
                    @can('delete product')
                    <td>
                      <form style="display: inline;" method="POST" action="{{ route('admin.products.destroy', $product->id)}}">
                        @csrf
                        @method('DELETE')
                      <button class="btn btn-icon btn-danger" onclick="return confirm('Confirm {{$product->name}} delete')" type="submit"><i class="fas fa-times"></i></button>
                      </form>
                    </td>
                    @endcan
                  </tr>
                  @endif
                 @endforeach
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
