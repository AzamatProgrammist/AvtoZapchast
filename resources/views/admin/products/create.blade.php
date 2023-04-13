@extends('layouts.admin')

@section('title')
    yangi tavar
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
      <div class="card">
          <div class="card-header">
            <h4>Yangi tavar qo'shish</h4>
          </div>
        <div class="card-body">
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
            @error('name')<div class="invalid-feedback">Oh no! This is invalid.</div>@enderror
          </div>
          <div class="form-group">
            <label>Orig/Dubl</label>
            <select name="Org_Dub" id="" class="form-control">
              <option>Tanlang Orig/Dubl</option>
              <option value="Оригинал">Оригинал</option>
              <option value="Дубликат">Дубликат</option>
            </select>
          </div>
          <div class="form-group">
            <label>Part Number</label>
            <input type="text" name="part_number" class="form-control">
          </div>
          <div class="form-group">
            <label>Rasmi</label>
            <input type="file" name="image" class="form-control">
          </div>
          <div class="form-group">
            <label>Modeli</label>
            <input type="text" name="model" class="form-control">
          </div>
          <div class="form-group">
            <label>Brendi</label>
            <input type="text" name="brendi" class="form-control">
          </div>
          <div class="form-group">
            <label>Markasi</label>
            <input type="text" name="markasi" class="form-control">
          </div>
          <div class="form-group">
            <label>Analog</label>
            <input type="text" name="analog" class="form-control">
          </div>
          <div class="form-group">
            <label>Chiqqan yili</label>
            <input type="date" name="chiqqan_yili" class="form-control">
          </div>
          <div class="form-group">
            <label>Kelgan vaqti</label>
            <input type="date" name="kelgan_yili" class="form-control">
          </div>
          <div class="form-group">
            <label>Size</label>
            <input type="text" name="size" class="form-control">
          </div>
          <div class="form-group">
            <label>Olingan narxi($)</label>
            <input type="number" name="olingan_narxi" class="form-control" placeholder="dollirdaa kiriting">
          </div>
          <div class="form-group">
            <label>Sotilish narxi</label>
            <input type="text" name="sotish_narxi" class="form-control">
          </div>
          <div class="form-group">
            <label>Og'irligi(1 dona)</label>
            <input type="number" name="weight" class="form-control" placeholder="1 ta tavar og'irligi">
          </div>
          <div class="form-group">
            <label>Yuk narxi($)</label>
            <input type="number" name="yuk_narxi" class="form-control" placeholder="1 kg yuk narxi dollirdaa">
          </div>
          <div class="form-group">
            <label>Soni</label>
            <input type="text" name="soni" class="form-control">
          </div>
          <div class="form-group">
            <label>Little</label>
            <input type="text" name="little" class="form-control">
          </div>
          <div class="form-group">
            <label>Many</label>
            <input type="text" name="many" class="form-control">
          </div>
          <div class="form-group">
            <label>Shops</label>
            <select name="shop_id" id="" class="form-control">
              @foreach($shops as $shop)
              <option value="{{ $shop->id }}">{{ $shop->name_uz }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Ombor</label>
            <select name="ombor_id" id="" class="form-control">
              @foreach($shops as $shop)
                @foreach($shop->warehouses as $warehouse)
                  <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                @endforeach
              @endforeach
            </select>
          </div>
          @can('create product')
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Save</button>
          </div>
          @endcan
        </div>
      </div>
    </form>
    </div>

@endsection