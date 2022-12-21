@extends('layouts.admin')

@section('title')
    Tavarlar
@endsection

@section('content')

    <div class="row ">
        <div class="col-12 col-md-6 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Products</h4>
              <div class="card-header-form">
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Qo'shish</a>
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
                    <th>Rasmi</th>
                    <th>Nomi</th>
                    <th>Markasi</th>
                    <th>Brendi</th>
                    <th>Modeli</th>
                    <th>Dubl/Org</th>
                    <th>Part no'mer</th>
                    <th>Soni</th>
                    <th>Narxi</th>
                    <th>Olingan narx</th>
                    <th>yuk narxi</th>
                    <th>Kg</th>
                    <th>To'liq narx</th>
                    <th>chiqqan yili</th>
                    <th>kelgan vaqti</th>
                    <th>O'lchami</th>
                    <th>Action</th>
                  </tr>
                  @foreach($products as $product)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                      <img width="40" src="/site/products/images/{{$product->image}}">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->markasi }}</td>
                    <td>{{ $product->brendi }}</td>
                    <td>{{ $product->model }}</td>
                    <td>{{ $product->Org_Dub }}</td>

                    <td>{{ $product->part_number }}</td>
                    <td>
                      @foreach($product->types as $type)
                       {{ $type->soni }}
                      @endforeach
                    </td>
                    
                    <td>
                      @foreach($product->types as $type)
                       {{ $type->sotish_narxi }} $
                      @endforeach
                    </td>
                    
                    <td>
                      @foreach($product->types as $type)
                       {{ $type->olingan_narxi }} $
                      @endforeach
                    </td>
                    
                    <td>
                      @foreach($product->types as $type)
                       {{ $type->yuk_narxi }} $
                      @endforeach
                    </td>
                    <td>
                      @foreach($product->types as $type)
                       {{ $type->weight }}
                      @endforeach
                    </td>
                    <td>
                      @foreach($product->types as $type)
                       {{ $type->full_price }} $
                      @endforeach
                    </td>
                    <td>
                      @foreach($product->types as $type)
                       {{ $type->chiqqan_yili }}
                      @endforeach
                    </td>
                    <td>
                      @foreach($product->types as $type)
                       {{ $type->kelgan_yili }}
                      @endforeach
                    </td>

                    <td>
                      @foreach($product->types as $type)
                       {{ $type->size }}
                      @endforeach
                    </td>
                    <td>
                      
                      <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-info">O'zgartirish</a>
                      <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-primary">Ko'rish</a>
                      <form style="display: inline;" method="POST" action="{{ route('admin.products.destroy', $product->id)}}">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-danger" onclick="return confirm('Confirm {{$product->name_uz}} delete')" type="submit" value="Delete">
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
                  {{ $products->links() }}
                </ul>
              </nav>
            </div>
          </div>
        </div>      
    </div>


    <div class="settingSidebar">
      <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
      </a>
      <div class="settingSidebar-body ps-container ps-theme-default">
        <div class=" fade show active">
          <div class="setting-panel-header">Setting Panel
          </div>
          <div class="p-15 border-bottom">
            <h6 class="font-medium m-b-10">Select Layout</h6>
            <div class="selectgroup layout-color w-50">
              <label class="selectgroup-item">
                <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                <span class="selectgroup-button">Light</span>
              </label>
              <label class="selectgroup-item">
                <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                <span class="selectgroup-button">Dark</span>
              </label>
            </div>
          </div>
          <div class="p-15 border-bottom">
            <h6 class="font-medium m-b-10">Sidebar Color</h6>
            <div class="selectgroup selectgroup-pills sidebar-color">
              <label class="selectgroup-item">
                <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                  data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
              </label>
              <label class="selectgroup-item">
                <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                  data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
              </label>
            </div>
          </div>
          <div class="p-15 border-bottom">
            <h6 class="font-medium m-b-10">Color Theme</h6>
            <div class="theme-setting-options">
              <ul class="choose-theme list-unstyled mb-0">
                <li title="white" class="active">
                  <div class="white"></div>
                </li>
                <li title="cyan">
                  <div class="cyan"></div>
                </li>
                <li title="black">
                  <div class="black"></div>
                </li>
                <li title="purple">
                  <div class="purple"></div>
                </li>
                <li title="orange">
                  <div class="orange"></div>
                </li>
                <li title="green">
                  <div class="green"></div>
                </li>
                <li title="red">
                  <div class="red"></div>
                </li>
              </ul>
            </div>
          </div>
          <div class="p-15 border-bottom">
            <div class="theme-setting-options">
              <label class="m-b-0">
                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                  id="mini_sidebar_setting">
                <span class="custom-switch-indicator"></span>
                <span class="control-label p-l-10">Mini Sidebar</span>
              </label>
            </div>
          </div>
          <div class="p-15 border-bottom">
            <div class="theme-setting-options">
              <label class="m-b-0">
                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                  id="sticky_header_setting">
                <span class="custom-switch-indicator"></span>
                <span class="control-label p-l-10">Sticky Header</span>
              </label>
            </div>
          </div>
          <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
            <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
              <i class="fas fa-undo"></i> Restore Default
            </a>
          </div>
        </div>
      </div>
    </div>


@endsection