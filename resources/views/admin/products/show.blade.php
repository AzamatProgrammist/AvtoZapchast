@extends('layouts.admin')

@section('title')
    Tavar
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      
        @csrf
      <div class="card">
          <div class="card-header">
            <h4>Tavar {{ $product->name }}</h4>
            <a href="{{ route('admin.products.index')}}" class="btn btn-primary">Orqaga</a>
          </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>Nomi</th><td>{{ $product->name }}</td>
              </tr>
              <tr>
                <th>Rasmi</th><td><img width="200" src="/site/products/images/{{ $product->image }}"></td>
              </tr>
              <tr>
                <th>Markasi</th>
                <td>
                  {{ $product->markasi }}
                </td>
              </tr>
              <tr>
                <th>Brendi</th>
                <td>
                  {{ $product->brendi }}
                </td>
              </tr>
              <tr>
                <th>Modeli</th>
                <td>
                  {{ $product->model }}
                </td>
              </tr>
              <tr>
                <th>Dubl/Org</th>
                <td>
                  {{ $product->Org_Dub }}
                </td>
              </tr>
              <tr>
                <th>Part no'mer</th>
                <td>
                  {{ $product->part_number }}
                </td>
              </tr>
              <tr>
                <th>Soni</th>
                <td>
                  {{ $product->soni }}
                </td>
              </tr>
              <tr>
                <th>Narxi</th>
                <td>
                  {{ $product->olingan_narxi }}
                </td>
              </tr>
              <tr>
                <th>Olingan narx</th>
                <td>
                  {{ $product->weight }}
                </td>
              </tr>
              <tr>
                <th>yuk narxi</th>
                  {{ $product->yuk_narxi }}
              </tr>
              <tr>
                <th>Kg</th>
                <td>
                  {{ $product->weight }}
                </td>
              </tr>
              <tr>
                <th>To'liq narx</th>
                <<td>
                  {{ $product->full_price }}
                </td>
              </tr>
              <tr>
                <th>chiqqan yili</th>
                <td>
                  {{ $product->chiqqan_yili }}
                </td>
              </tr>
              <tr>
                <th>kelgan vaqti</th>
                <td>
                  {{ $product->kelgan_yili }}
                </td>
              </tr>
              <tr>
                <th>O'lchami</th>
                <td>
                  {{ $product->size }}
                </td>
              </tr>

              <tr>
                <th>Qo'shilgan vaqti</th><td>{{ $product->created_at }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>

    </div>

@endsection