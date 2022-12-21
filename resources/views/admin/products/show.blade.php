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
                  @foreach($product->types as $type)
                  {{ $type->soni }}
                  @endforeach
                </td>
              </tr>
              <tr>
                <th>Narxi</th>
                <td>
                  @foreach($product->types as $type)
                  {{ $type->olingan_narxi }}
                  @endforeach
                </td>
              </tr>
              <tr>
                <th>Olingan narx</th>
                <td>
                  @foreach($product->types as $type)
                  {{ $type->weight }}
                  @endforeach
                </td>
              </tr>
              <tr>
                <th>yuk narxi</th>
                @foreach($product->types as $type)
                  {{ $type->yuk_narxi }}
                  @endforeach
              </tr>
              <tr>
                <th>Kg</th>
                <td>
                  @foreach($product->types as $type)
                  {{ $type->weight }}
                  @endforeach
                </td>
              </tr>
              <tr>
                <th>To'liq narx</th>
                <<td>
                  @foreach($product->types as $type)
                  {{ $type->full_price }}
                  @endforeach
                </td>
              </tr>
              <tr>
                <th>chiqqan yili</th>
                <td>
                  @foreach($product->types as $type)
                  {{ $type->chiqqan_yili }}
                  @endforeach
                </td>
              </tr>
              <tr>
                <th>kelgan vaqti</th>
                <td>
                  @foreach($product->types as $type)
                  {{ $type->kelgan_yili }}
                  @endforeach
                </td>
              </tr>
              <tr>
                <th>O'lchami</th>
                <td>
                  @foreach($product->types as $type)
                  {{ $type->size }}
                  @endforeach
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