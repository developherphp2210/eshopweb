<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="book-open"></i></div>
                            Volantino
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">                
        <hr class="mt-0 mb-4" />  
        <form action="{{url('promotion/filepdf')}}" method="post" id="myform" enctype="multipart/form-data">         
        <div class="row">
        
        {{csrf_field()}}    
                <div class="col-6">
                    <!-- Profile picture card-->
                    <div class="card">
                            <input class="form-control" type="file" name="file" accept=".pdf" id="uploadFile">                        
                    </div>
                </div>                        
                <div class="col-3">
                    <button class="btn btn-primary" id="importa_volantino" type="button">Importa Volantino</span>
                    </button>
                </div>        
                <div class="col-3">
                    <input type="hidden" name="delete" id="delete" value="0" >
                    <button class="btn btn-danger" type="button" id="elimina_volantino" >Elimina Volantino</button>
                </div>                                                       
        </div>                    
        </form>
            @if (session('filepdf') != '')
            <div class="row mt-5">      
                <div id="book">
        
                </div>     
            </div>
            @endif
        
    </div>
</main>  
<script>
    $("#book").wowBook({
        
		container: true,
        pdf: "{{asset('storage/'.session('filepdf'))}}",
        pdfFind: true,
        controls:{
            fullscreen : "#fullscreen_button"
        },
        toolbar: "back, zoomin,zoomout, find, right"
    });

</script>          