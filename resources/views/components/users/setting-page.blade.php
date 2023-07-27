<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="settings"></i></div>
                            Impostazioni
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">                
        <hr class="mt-0 mb-4" />
        <div class="row">
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                <form action="{{url('savesetting')}}" method="post" >
                    <div class="card-body">
                        @if ($notification != '')
                            @if ($notification['status'])
                                <div class="alert alert-success" id="alert" role="alert">
                            @else
                                <div class="alert alert-danger" id="alert" role="alert">   
                            @endif        
                                {{$notification['message']}}
                            </div>
                        @endif
                        {{csrf_field()}}
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="small mb-1" for="testat">Inserisci un titolo di Benvenuto</label>
                                <input class="form-control" id="testata" type="text" name="testata" value="{{$setting->testata}}" />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-8">
                                <label class="small mb-1" for="desart">Inserisci una piccola descrizione della tua Attività</label>
                                <textarea class="form-control" id="desart" rows="4" cols="50" name="corpo">{{$setting->corpo}}</textarea>
                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Memorizza</button>
                    </div>
                </form>    
                </div>
            </div>
        </div>

        <div class="card card-waves mb-4 mt-5">
      <div class="card-body p-5">
        <div class="row align-items-center justify-content-between">
          <div class="col">
            <h2 class="text-primary">{{$setting->testata}}</h2>
            <p class="text-gray-700">{{$setting->corpo}}</p>
            <h1 class="text-info">Totale punti fidelity: <span>XXXX</span></h1>
          </div>
          <div class="col">
            <div class="card bg-primary border-0">
              <div class="card-body">
                <h5 class="text-white-50">Fidelity Card</h5>
                <div class="mb-4">
                  <div class="d-flex justify-content-center">
                    <svg id="barcode"></svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <script>
    JsBarcode("#barcode", "0000000000000", {
      format: "EAN13",
      width: 4,
      height: 70,
      displayValue: true
    });
    </script>
</main>