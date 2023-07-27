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
    <div class="card card-waves mb-4 mt-5">
      <div class="card-body p-5">
        <div class="row align-items-center justify-content-between">
          <div class="col">
            <h2 class="text-primary">{{session('testata')}}</h2>
            <p class="text-gray-700">{{session('corpo')}}</p>
            <h1 class="text-info">Totale punti fidelity: <span>{{session('punti_fidelity')}}</span></h1>
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
    @if (session('filepdf') != '')
    <div class="row mt-5">      
      <div id="book">
        
      </div>     
    </div>     
    @endif
  </div>
  <script>
    $("#book").wowBook({       
		  container: true,
      pdf: "{{asset('storage/'.session('filepdf'))}}",
      pdfFind: true,
      toolbar: "back, zoomin,zoomout, find, right"
    });
      
    JsBarcode("#barcode", "{{session('codice_fidelity')}}", {
      format: "EAN13",
      width: 4,
      height: 70,
      displayValue: true
    });

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