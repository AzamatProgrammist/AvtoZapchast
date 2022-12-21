@extends('layouts.admin')

@section('title')
    Update taver
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      <form method="POST" action="{{ route('admin.products.update', $product->id)}}">
        @csrf
        @method('PUT')
      <div class="card">
          <div class="card-header">
            <h4>Tavarni o'zgartirish</h4>
          </div>
        <div class="card-body">
          <div class="form-group">
            <label>Name</label>
            <input type="text" value="{{ $product->name}}" name="name" class="form-control @error('name') is-invalid @enderror">
            @error('name')<div class="invalid-feedback">Oh no! this is invalid.</div>@enderror
          </div>
          
          <div class="form-group">
            <label>Rasmi</label>
            <img src="/site/products/images/{{ $product->image}}" width="100">
            <input type="file" name="image" class="form-control" name="image">
          </div>

          <div class="form-group">
            <label>Markasi</label>
            <input type="text" value="{{ $product->markasi}}" name="markasi" class="form-control">
          </div>
          <div class="form-group">
            <label>Brendi</label>
            <input type="text" value="{{ $product->brendi}}" name="brendi" class="form-control">
          </div>
          <div class="form-group">
            <label>Modeli</label>
            <input type="text" value="{{ $product->model}}" name="model" class="form-control">
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
            <input type="text" value="{{ $product-> part_number}}" name="part_number" class="form-control">
          </div>
          <div class="form-group">
            <label>Soni</label>
            @foreach($product->types as $type)
            <input type="text" value="{{ $type->soni}}" name="soni" class="form-control">
            @endforeach
          </div>
          <div class="form-group">
            <label>Sotish narxi</label>
            @foreach($product->types as $type)
            <input type="text" value="{{ $type->sotish_narxi}}" name="sotish_narxi" class="form-control">
            @endforeach
          </div>
          <div class="form-group">
            <label>Olingan narxi</label>
            @foreach($product->types as $type)
            <input type="text" value="{{ $type->olingan_narxi}}" name="olingan_narxi" class="form-control">
            @endforeach
          </div>
          <div class="form-group">
            <label>Yuk narxi</label>
            @foreach($product->types as $type)
            <input type="text" value="{{ $type->yuk_narxi}}" name="yuk_narxi" class="form-control">
            @endforeach
          </div>
          <div class="form-group">
            <label>Umumiy kg</label>
            @foreach($product->types as $type)
            <input type="text" value="{{ $type->weight}}" name="weight" class="form-control">
            @endforeach
          </div>
          <div class="form-group">
            <label>Umumiy narxi</label>
            @foreach($product->types as $type)
            <input type="text" value="{{ $type->full_price}}" name="full_price" class="form-control">
            @endforeach
          </div>
          <div class="form-group">
            <label>Chiqqan yili</label>
            @foreach($product->types as $type)
            <input type="text" value="{{ $type->chiqqan_yili}}" name="chiqqan_yili" class="form-control">
            @endforeach
          </div>
          <div class="form-group">
            <label>Kelgan vaqti</label>
            @foreach($product->types as $type)
            <input type="text" value="{{ $type->kelgan_yili}}" name="kelgan_yili" class="form-control">
            @endforeach
          </div>
          <div class="form-group">
            <label>Size</label>
            @foreach($product->types as $type)
            <input type="text" value="{{ $type->size}}" name="size" class="form-control">
            @endforeach
          </div>
          <div class="form-group">
            <label>Qo'shilgan vati</label>
            @foreach($product->types as $type)
            <input type="text" value="{{ $type->created_at}}" name="created_at" class="form-control">
            @endforeach
          </div>
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Update</button>
          </div>
        </div>
      </div>
    </form>
    </div>

@endsection