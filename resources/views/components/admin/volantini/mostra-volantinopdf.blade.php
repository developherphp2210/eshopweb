<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="book-open"></i></div>
                            {{$volantino->nome}}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container-xl px-4 mt-4">
        <div class="row mt-5">      
            <div class="col-12" id="book">
                
            </div>     
        </div>
    </div>
    <script>
    $("#book").wowBook({       
		  container: true,
      pdf: "{{asset('storage/'.$volantino->path)}}",
      pdfFind: true,
      toolbar: "back, zoomin,zoomout, find, right"
    });
    </script>
</main>