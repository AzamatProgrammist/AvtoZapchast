@extends('layouts.admin')

@section('title')
    Astatka
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
        <div class="card">
            <div class="card-header">
              <h4>@lang('words.barcode')</h4>
              <div class="card-header-form">
                @if(isset($shop))
              <form method="POST" action="{{ route('admin.barcodes.clear')}}">
                  @csrf
                  <input type="hidden" name="id" value="{{ $shop->id }}" class="btn btn-success">
                  <input type="submit" name="btn" value="yangitdan" class="btn btn-success">
              </form>
                @endif
              </div>
            </div>
            @if(session('message'))
              <div class="alert alert-success alert-dismissible show fade col-lg-4">
                <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                    <span>×</span>
                  </button>
                  {{ session('message') }}
                </div>
              </div>
            @endif
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card-body">
                    <div class="form-group">
                        @if(isset($shop))
                        <form id="barcodeForm">
                            @csrf
                            <label>@lang('words.shops') <b>{{ $shop->name_uz }}</b></label>
                            <input type="hidden" id="hiddenDataInput" name="hiddenData" value="{{ $shop->id }}">
                            <div class="section-title">Barcode</div>
                            <input id="textDataInput" name="textData" type="text" class="form-control" autofocus>
                        </form>
                        @else
                        <div class="section-title">Select Shop</div>
                        <form action="{{ route('admin.barcodes.select_shop')}}" method="POST">
                            @csrf
                            <select name="id" class="form-control select2">
                                @foreach($shops as $shop)
                                <option value="{{ $shop->id }}">{{ $shop->name_uz }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                        @endif
                    </div>
                    <div id="resultDiv"></div>
                    <div id="error-message"></div>
                    <table id="barcodesTable" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Barcode</th>
                                <th>Count</th>
                                <th>name</th>
                                <th>Org_Dub</th>
                                <th>model</th>
                                <th>brendi</th>
                                <th>markasi</th>
                                <th>size</th>
                                <th>Price</th>
                                <th>weight</th>
                            </tr>
                        </thead>
                        <tbody id="barcodesTableBody"></tbody>
                    </table>
                    <table id="barcodesTable" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Barcode</th>
                                <th>Count</th>
                                <th>Name</th>
                                <th>Org_Dub</th>
                                <th>Model</th>
                                <th>Brend</th>
                                <th>Price</th>
                                <th>Full price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($inkassas))
                                @foreach($inkassas as $inkassa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $inkassa['barcode'] }}</td>
                                        <td>{{ $inkassa['soni'] }}</td>
                                        <td>{{ $inkassa['name'] }}</td>
                                        <td>{{ $inkassa['Org_Dub'] }}</td>
                                        <td>{{ $inkassa['model'] }}</td>
                                        <td>{{ $inkassa['brendi'] }}</td>
                                        <td>{{ $inkassa['sotish_narxi'] }}</td>
                                        <td>{{ $inkassa['full_price'] }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
                    
                </div>
            </div>
        </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {

        $('#textDataInput').on('input', function() {

            var hiddenData = $('#hiddenDataInput').val();
            var textData = $('#textDataInput').val();

            $.ajax({
                url: '/admin/barcodes/barcode',
                method: 'POST',
                data: {
                    hiddenData: hiddenData,
                    textData: textData,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.success) {
                        console.log(response);
                        document.getElementById('textDataInput').value = '';

                        var barcodesTableBody = $('#barcodesTableBody');
                        barcodesTableBody.empty(); // Eski ma'lumotlarni tozalash

                        for (var i = 0; i < response.barcodes.length; i++) {
                            var barcode = response.barcodes[i];
                            var id = barcode.id;
                            var code = barcode.barcode;
                            var count = barcode.count;
                            var name = barcode.name;
                            var Org_Dub = barcode.Org_Dub;
                            var model = barcode.model;
                            var brendi = barcode.brendi;
                            var markasi = barcode.markasi;
                            var size = barcode.size;
                            var sotish_narxi = barcode.sotish_narxi;
                            var weight = barcode.weight;

                            // Qaytgan ma'lumotlarni HTMLga qo'shish
                            var row =
                                '<tr>' +
                                '<td>' + id + '</td>' +
                                '<td>' + code + '</td>' +
                                '<td>' + count + '</td>' +
                                '<td>' + name + '</td>' +
                                '<td>' + Org_Dub + '</td>' +
                                '<td>' + model + '</td>' +
                                '<td>' + brendi + '</td>' +
                                '<td>' + markasi + '</td>' +
                                '<td>' + size + '</td>' +
                                '<td>' + sotish_narxi + '</td>' +
                                '<td>' + weight + '</td>' +
                                '</tr>';
                            barcodesTableBody.append(row);
                        }
                    } else {
                        // Xatolik haqida xabar berish
                        $('#resultDiv').html('Xatolik yuz berdi.');
                    }
                },
                error: function(xhr, status, error) {
                    // Xatolik haqida xabar berish
                    $('#resultDiv').html('Xatolik yuz berdi. Iltimos, qaytadan urinib kor');
                    console.log(error);
                }
            });
        });
        
    });

</script>

@endsection
