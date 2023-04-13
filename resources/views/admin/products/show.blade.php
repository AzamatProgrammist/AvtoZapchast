@extends('layouts.admin')

@section('title')
    Tavar
@endsection

@section('content')

                <div class="card">
                  <div class="card-header">
                    <h4>Mahsulot</h4>
                    <a href="{{ route('admin.products.index')}}" class="btn btn-primary">Orqaga</a>
                  </div>
                  <div class="card-body">
                    <div class="section-title mt-0">Asosiy ma'lumotlari</div>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Rasmi</th>
                          <th scope="col">Nomi</th>
                          <th scope="col">Markasi</th>
                          <th scope="col">Brendi</th>
                          <th scope="col">Model</th>
                          <th scope="col">Dub/Org</th>
                          <th scope="col">Chiqqan yili</th>
                          <th scope="col">Kelgan vaqti</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td><img width="100" src="/site/products/images/{{ $product->image }}"></td>
                          <td>{{ $product->name }}</td>
                          <td>{{ $product->markasi }}</td>
                          <td>{{ $product->brendi }}</td>
                          <td>{{ $product->model }}</td>
                          <td>{{ $product->Org_Dub }}</td>
                          <td>{{ $product->chiqqan_yili }}</td>
                          <td>{{ $product->kelgan_yili }}</td>
                        </tr>
                       
                      </tbody>
                    </table>
                    <div class="section-title">Qo'shimcha ma'lumotlar</div>
                    <table class="table table-hover table-dark">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Part nomer</th>
                          <th scope="col">Umumiy soni</th>
                          <th scope="col">Narxi</th>
                          <th scope="col">Olingan narxi</th>
                          <th scope="col">Yuk narxi</th>
                          <th scope="col">Kg</th>
                          <th scope="col">O'lchami</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>{{ $product->part_number }}</td>
                          <td>{{ $product->soni }}</td>
                          <td>{{ $product->sotish_narxi }}$</td>
                          <td>{{ $product->olingan_narxi }}$</td>
                          <td>{{ $product->yuk_narxi }}$</td>
                          <td>{{ $product->weight }}</td>
                          <td>{{ $product->size }}</td>
                        </tr>
                        
                      </tbody>
                    </table>
                    <div class="section-title mt-0">Tavarlar Xolati</div>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          
                          <th scope="col">#</th>
                              <?php $inkassaSub_num = 0; ?>
                              @foreach($shops as $shop)
                                <?php $num = 0; ?>
                                @if($shop->user->usertype == 0)
                                  @foreach($product->inkassaSubs as $inkassaSub)
                                    
                                    @if($inkassaSub->shop_id == $shop->id)
                                      <?php 
                                        $num = $num + $inkassaSub->soni; 
                                        $inkassaSub_num = $inkassaSub_num + $inkassaSub->soni;
                                      ?>
                                    @endif
                                  @endforeach

                                  @if($num > 0)
                                    <th scope="col">{{ $shop->name_uz }}</th>
                                  @endif
                                @endif
                              @endforeach

                              @foreach($shops as $shop)
                                @if($shop->user->usertype == 1)
                                <th scope="col">{{ $shop->name_uz }}</th>
                                @endif
                              @endforeach

                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                              
                              <?php $inkassa_num = 0; ?>
                              @foreach($shops as $shop)
                                <?php $num = 0; ?>
                                @if($shop->user->usertype == 0)
                                  @foreach($product->inkassaSubs as $inkassaSub)
                                    
                                    @if($inkassaSub->shop_id == $shop->id)
                                      <?php 
                                        $num = $num + $inkassaSub->soni; 
                                        $inkassa_num = $inkassa_num + $inkassaSub->soni;
                                      ?>
                                    @endif
                                  @endforeach

                                  @if($num > 0)
                                    <td>{{ $num }}</td>
                                  @endif
                                @endif
                              @endforeach

                              @foreach($shops as $shop)
                                @if($shop->user->usertype == 1)
                                  <td>{{ $product->soni - $inkassa_num }}</td>
                                @endif
                              @endforeach
                              
                        </tr>
                       
                      </tbody>
                    </table>
                  </div>
                </div>

@endsection