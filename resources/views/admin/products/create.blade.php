@extends('layouts.admin')

@section('title')
    Create product
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      <form method="POST" action="{{ route('admin.products.store')}}" enctype="multipart/form-data">
        @csrf
      <div class="card">
          <div class="card-header">
            <h4>Create product</h4>
          </div>
        <div class="card-body">
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
            @error('name')<div class="invalid-feedback">Oh no! This is invalid.</div>@enderror
          </div>
          <div class="form-group">
            <label>Org/Dubl</label>
            <select name="Org_Dub" id="" class="form-control">
              <option>Select Original/Dublikat</option>
              
              <option value="Оригинал">Оригинал</option>
              <option value="Дубликат">Дубликат</option>
              
            </select>
          </div>
          <div class="form-group">
            <label>Part Number</label>
            <input type="text" name="part_number" class="form-control">
          </div>
          <div class="form-group">
            <label>Image</label>
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
            <label>Chiqqan yili</label>
            <input type="text" name="chiqqan_yili" class="form-control">
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
            <label>Full price</label>
            <input type="text" name="full_prize" class="form-control">
          </div>
          <div class="form-group">
            <label>Sotish narxi</label>
            <input type="text" name="sotish_narxi" class="form-control">
          </div>
          <div class="form-group">
            <label>Olingan narxi</label>
            <input type="text" name="olingan_narxi" class="form-control">
          </div>
          <div class="form-group">
            <label>weight</label>
            <input type="text" name="weight" class="form-control">
          </div>
          <div class="form-group">
            <label>Yuk narxi</label>
            <input type="text" name="yuk_narxi" class="form-control">
          </div>
          <div class="form-group">
            <label>Soni</label>
            <input type="text" name="soni" class="form-control">
          </div>
          <div class="form-group">
            <label>Dokon</label>
            <select name="Org_Dub" id="" class="form-control">
              <option>Select Dokon</option>
              
              <option value="Оригинал">dokon1</option>
              <option value="Дубликат">dokon2</option>
              
            </select>
          </div>
          <div class="form-group">
            <label>Ombor</label>
            <select name="ombor_id" id="" class="form-control">
              <option>Select Ombor</option>
              
              <option value="1">Ombor1</option>
              <option value="2">Ombor2</option>
              
            </select>
          </div>
          
          <div class="form-group">
            <label>Soni</label>
            <input type="text" name="soni" class="form-control">
          </div>
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Save</button>
          </div>
        </div>
      </div>
    </form>
    </div>

@endsection