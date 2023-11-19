@extends('layouts.admin')

@section('title')
    Update taver
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
      <div class="card">
          <div class="card-header">
            <h4>Tavarni o'zgartirish</h4>
          </div>
        <div class="card-body">
          <div class="form-group">
            <label>Name</label>
            <input type="text" value="{{ $product->name }}" name="name" class="form-control @error('name') is-invalid @enderror">
            @error('name')<div class="invalid-feedback">Oh no! this is invalid.</div>@enderror
          </div>
          
          <div class="form-group">
            <label>Rasmi</label>
            <img src="/site/products/images/{{ $product->image}}" width="100">

            <input type="hidden" name="oldimage" class="form-control" value="{{ $product->image }}">
            <input type="file" name="image" class="form-control" name="image">
          </div>

          <div class="form-group">
            <label>Markasi</label>
            <input type="text" value="{{ $product->markasi }}" name="markasi" class="form-control">
          </div>
          <div class="form-group">
            <label>Brendi</label>
            <input type="text" value="{{ $product->brendi }}" name="brendi" class="form-control">
          </div>
          <div class="form-group">
            <label>Modeli</label>
            <input type="text" value="{{ $product->model }}" name="model" class="form-control">
          </div>
          <div class="form-group">
            <label>Analog</label>
            <input type="text" value="{{ $product->analog }}" name="analog" class="form-control">
          </div>
          <div class="form-group">
            <label>Org_Dub</label>
            <select name="Org_Dub" id="" class="form-control">
              <option value="{{ $product->Org_Dub }}" {{ $product->Org_dub=='Дубликат' ? 'selected' : '' }} >{{ $product->Org_Dub }}</option>
              <option value="Дубликат" >Дубликат</option>
              <option value="Оригинал" >Оригинал</option>
            </select>
          </div>
          <div class="form-group">
            <label>Part number</label>
            <input type="text" value="{{ $product->part_number }}" name="part_number" class="form-control">
          </div>
          <div class="form-group">
            <label>Soni</label>
            <input type="text" value="{{ $product->soni }}" name="soni" class="form-control">
          </div>
          <div class="form-group">
            <label>Little</label>
            <input type="text" value="{{ $product->little }}" name="little" class="form-control">
          </div>
          <div class="form-group">
            <label>Many</label>
            <input type="text" value="{{ $product->many }}" name="many" class="form-control">
          </div>
          <div class="form-group">
            <label>Sotish narxi</label>
            <input type="text" value="{{ $product->sotish_narxi }}" name="sotish_narxi" class="form-control">
          </div>
          <div class="form-group">
            <label>Olingan narxi</label>
            <input type="text" value="{{ $product->olingan_narxi }}" name="olingan_narxi" class="form-control">
          </div>
          <div class="form-group">
            <label>Yuk narxi(1 dona)</label>
            <input type="text" value="{{ $product->yuk_narxi }}" name="yuk_narxi" class="form-control">
          </div>
          <div class="form-group">
            <label>KG(1 ta tavar og'irligi)</label>
            <input type="text" value="{{ $product->weight }}" name="weight" class="form-control">
          </div>
          <div class="form-group">
            <label>Chiqqan yili</label>
            <input type="text" value="{{ $product->chiqqan_yili }}" name="chiqqan_yili" class="form-control">
          </div>
          <div class="form-group">
            <label>Kelgan vaqti</label>
            <input type="text" value="{{ $product->kelgan_yili }}" name="kelgan_yili" class="form-control">
          </div>
          <div class="form-group">
            <label>Size</label>
            <input type="text" value="{{ $product->size }}" name="size" class="form-control">
          </div>
          <div class="form-group">
            <label>Qo'shilgan vaqti</label>
            <input type="text" value="{{ $product->created_at }}" name="created_at" class="form-control">
          </div>
          <input type="hidden" name="shop_id" value="{{ $product->shop_id }}">
          <input type="hidden" name="ombor_id" value="{{ $product->ombor_id }}">
          <input type="hidden" name="user_id" value="{{ $product->user_id }}">
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          @can('edit product')
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Update</button>
          </div>
          @endcan
        </div>
      </div>
    </form>
    </div>

@endsection