@extends('layouts.admin')

@section('title')
    Остатки
@endsection

@section('content')


  <!-- Main Content -->
        <section class="section">
          <div class="section-body">
            <div class="invoice" id="invoice">
              <div class="invoice-print" id="printSection">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="invoice-title">
                      <h2>Hisob-faktura</h2>
                        <div class="invoice-number">OCT-{{ $shop->name_uz }}</div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <address>
                          
                        </address>
                      </div>
                      <div class="col-md-6 text-md-right">
                        <address>
                          
                        </address>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        
                      </div>
                      <div class="col-md-6 text-md-right">
                        <address>
                          
                        </address>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="section-title">Buyurtma xulosasi</div>
                    <p class="section-lead"></p>
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">

                        <tr>
                          <th data-width="40">#</th>
                          <th class="text-center">Part no'mer</th>
                          <th>Nomi</th>
                          <th class="text-center">Marka</th>
                          <th class="text-center">Brend</th>
                          <th class="text-center">Model</th>
                          <th class="text-center">Dubl/Org</th>
                          <th class="text-center">Soni</th>
                          <th class="text-center">Narxi</th>
                          <th class="text-right">Jami narxi</th>
                        </tr>
                        @foreach($astatkas as $astatka)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $astatka->part_number }}</td>
                          <td>{{ $astatka->name }}</td>
                          <td>{{ $astatka->markasi }}</td>
                          <td>{{ $astatka->brendi }}</td>
                          <td>{{ $astatka->model }}</td>
                          <td>{{ $astatka->Org_Dub }}</td>
                          <td class="text-center">{{ $astatka->soni }}</td>
                          <td class="text-center">{{ $astatka->sotish_narxi }} $</td>
                          <td class="text-right">{{ $astatka->full_price }} $</td>
                        </tr>
                        @endforeach
                      </table>
                    </div>
                    <div class="row mt-4">
                      <div class="col-lg-8">
                        
                      </div>
                      <div class="col-lg-4 text-right">
                        
                        <hr class="mt-2 mb-2">
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">Jami summa</div>
                          <div class="invoice-detail-value invoice-detail-value-lg">{{ $confirm->total_price }} $</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="text-md-right">
                <button id="printBtn" onclick="printInvoice('printSection')" class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>

                <!-- <button id="printPDF" onclick="generatePDF('invoice')" class="btn btn-danger btn-icon icon-left"><i class="fas fa-download"></i> Download</button> -->
                
              </div>
            </div>
          </div>
        </section>

<script type="text/javascript">

  function printInvoice(printBtn){
    var printContent = document.getElementById(printBtn).innerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContent;
}

function generatePDF(printPDF){
  var element = document.getElementById('invoice');
  html2pdf(element)
  save();
}
 
</script>

@endsection