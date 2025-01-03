<main>
  <div class="container-xl px-4 mt-5">
    <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
      <div class="me-4 mb-3 mb-sm-0">
        <h1 class="mb-0">Dashboard</h1>
        <div class="small">
          <span class="fw-500 text-primary" id="day"></span>
          <span id="datafull"></span>
        </div>
      </div>
    </div> 
    <div class="row">
      @foreach($lista['Fidelity'] as $fidelity)
      <div class="col-12 col-xl-4">
        <div class="card card-waves mb-4 mt-5">
          <div class="card-body p-5">
            <div class="row align-items-center justify-content-between">
              <div class="col">
                <h2 class="text-primary text-center">{{$fidelity->descrizione}}</h2>
                <p class="text-gray-700">{{session('corpo')}}</p>                
                <div class="card bg-primary border-0">
                  <div class="card-body">
                    <!-- <h5 class="text-white-50">Fidelity Card</h5> -->
                    <div class="mb-4">
                      <div class="d-flex justify-content-center">
                        <svg id="barcode{{$fidelity->id}}"></svg>
                      </div>
                      <h5 class="text-center text-white">{{session('user')->nome.' '.session('user')->cognome}}</h5>
                    </div>
                  </div>                  
                </div>
                <h1 class="text-info text-center mt-2">Totale Punti: <span>{{($fidelity->punti == '') ? '0' : $fidelity->punti }}</span></h1>              
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
        JsBarcode("#barcode{{$fidelity->id}}", "{{$fidelity->codice}}", {
          format: "EAN13",
          width: 4,
          height: 70,
          displayValue: true
        });
      </script>
      @endforeach
    </div>  
    
    @foreach($lista['pdf'] as $pdf)
    <div class="row mt-5">
      <div class="card p-3">
        <div class="card-header">
          <h1 class="text-center">{{$pdf->nome}}</h1>
        </div>
        <div class="card-body">
        <div id="book{{$pdf->id}}"></div>     
        </div>
      </div>            
    </div>
    <script>
      $("#book{{$pdf->id}}").wowBook({       
        container: true,
        pdf: "{{asset('storage/'.$pdf->path)}}",
        pdfFind: false,
        slideShow: true,
        slideShowDelay: 5000,
        slideShowLoop: true,
        startSlideShow: true,
        toolbar: "back, zoomin,zoomout, right,slideshow,fullscreen"
      });
    </script>     
    @endforeach
  </div>
  <script>
                
    window.onload = setInterval(Orologio, 6000);

    function addZero(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    }

    function Orologio() {

      var mesi = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];
      var giorno = ['Domenica', 'Lunedi', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato'];

      var d = new Date();
      var ora = addZero(d.getHours());
      var min = addZero(d.getMinutes());
      var gio = addZero(d.getDate());
      var mes = d.getMonth();
      var anno = addZero(d.getFullYear());
      document.getElementById('datafull').innerHTML = ' &middot ' + gio + ' ' + mesi[mes] + ' ' + anno + ' &middot ' + ora + ":" + min;
      document.getElementById('day').innerHTML = giorno[d.getDay()];
    }

    Orologio();
  </script>
</main>