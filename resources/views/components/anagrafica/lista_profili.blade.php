<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Anagrafiche - Lista Profili
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="px-4 mt-4">
        <div class="row g-4 g-xl-6">
            <div class="col-xl-5 col-xxl-5">
                <div class="p-1 mb-2">
                    <button type="button" id="addprofilo" class="btn btn-primary">Aggiungi un Profilo</button>
                </div>
                <div class="table-responsive">
                    <table id="lista" class="table table-striped table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>Codice</th>
                                <th>Descrizione</th>                                
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listaprofili as $profilo)
                            <tr onclick="schedaPro({{$profilo->id}})">
                                <td>{{$profilo->codice}}</td>
                                <td>{{$profilo->descrizione}}</td>                                
                                <td>
                                    <a title="Elimina" onclick="return confirm(`Sei sicuro di voler cancellare il Profilo {{$profilo->descrizione}} ? `)" href="{{url('/profilodelete/'.$profilo->id)}}">
                                            <button class="btn btn-datatable btn-icon btn-transparent-dark"><i style="color:red" data-feather="trash-2"></i></button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        <div class="col-xl-7 col-xxl-7 p-4">
            <div class="sticky-leads-sidebar">
                <div class="card mb-4">        
                    <div class="card-body">
                        @if($listaprofili->count() > 0)
                            <form action="{{@url('/profiloupdate/'.$listaprofili[0]->id)}}" enctype="multipart/form-data" id="profiloform" method="post">
                                <div class="card-body">                                
                                    {{csrf_field()}}
                                    <div class="row">                                    
                                        <div class="col-4">
                                            <h5 class="mb-1">Codice</h5>
                                            <input class="form-control" type="text" maxlength="6" id="codice" name="codice" value="{{$listaprofili[0]->codice}}">
                                        </div>                                        
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-8">
                                            <h5 class="mb-1">Descrizione</h5>
                                            <input class="form-control" type="text" maxlength="25" required name="descrizione" id="descrizione" value="{{$listaprofili[0]->descrizione}}">
                                        </div>
                                    </div>
                                    <nav class="nav nav-borders mt-4">
                                        <a class="nav-link active ms-0 tablinks" onclick="openTab(event, 'frontend')" href="#">Permessi FrontEnd</a>
                                        <a class="nav-link tablinks" onclick="openTab(event, 'cassa')" href="#">Permessi Cassa</a>                                                                                
                                    </nav>
                                    <div class="tabcontent" id="frontend" style="display: block">
                                        <div class="row mt-4">                                            
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <h5 class="mb-1">Dashboard</h5>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input ms-auto" type="checkbox" name="dashboard" role="switch" {{($listaprofili[0]->dashboard == '1') ? 'checked' : ''}} id="dashboard">
                                                        </div>
                                                    </div>
                                                </div>   
                                            </div>
                                        </div>
                                        <div class="row mt-4">                                            
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <h5 class="mb-1">Anagrafiche</h5>
                                                    </div>
                                                    <div class="col-2">    
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input ms-auto" type="checkbox" name="anagrafiche" role="switch" {{($listaprofili[0]->anagrafiche == '1') ? 'checked' : ''}} id="anagrafiche">
                                                        </div>   
                                                    </div>    
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="row mt-4">                                            
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <h5 class="mb-1">Cassieri</h5>
                                                    </div>
                                                    <div class="col-2">                                                            
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input ms-auto" type="checkbox" name="cassieri" role="switch" {{($listaprofili[0]->cassieri == '1') ? 'checked' : ''}} id="cassieri">
                                                        </div> 
                                                    </div>    
                                                </div>  
                                            </div>
                                        </div>
                                    </div>                                                                                                             
                                    <div class="tabcontent" id="cassa">
                                        <div class="row mt-4">                                            
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h5 class="mb-1">Versamenti</h5>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input ms-auto" type="checkbox" name="versamenti" role="switch" {{($listaprofili[0]->versamenti == '1') ? 'checked' : ''}} id="versamenti">
                                                        </div>
                                                    </div>                                                    
                                                </div>   
                                            </div>                                            
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h5 class="mb-1">Prelievi</h5>
                                                    </div>
                                                    <div class="col-4">    
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input ms-auto" type="checkbox" name="prelievi" role="switch" {{($listaprofili[0]->prelievi == '1') ? 'checked' : ''}} id="prelievi">
                                                        </div>   
                                                    </div>    
                                                </div>    
                                            </div>
                                        </div>                                        
                                        <div class="row mt-4">                                            
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h5 class="mb-1">Richiama Scontrino</h5>
                                                    </div>
                                                    <div class="col-4">                                                            
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input ms-auto" type="checkbox" name="richiama_scontrino" role="switch" {{($listaprofili[0]->richiama_scontrino == '1') ? 'checked' : ''}} id="richiama_scontrino">
                                                        </div> 
                                                    </div>    
                                                </div>  
                                            </div>                                            
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h5 class="mb-1">Annulla Scontrino</h5>
                                                    </div>
                                                    <div class="col-4">                                                            
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input ms-auto" type="checkbox" name="annulla_scontrino" role="switch" {{($listaprofili[0]->annulla_scontrino == '1') ? 'checked' : ''}} id="annulla_scontrino">
                                                        </div> 
                                                    </div>    
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="row mt-4">                                            
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h5 class="mb-1">Sconti</h5>
                                                    </div>
                                                    <div class="col-4">                                                            
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input ms-auto" type="checkbox" name="sconti" role="switch" {{($listaprofili[0]->sconti == '1') ? 'checked' : ''}} id="sconti">
                                                        </div> 
                                                    </div>    
                                                </div>  
                                            </div>                                            
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h5 class="mb-1">Correzioni</h5>
                                                    </div>
                                                    <div class="col-4">                                                            
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input ms-auto" type="checkbox" name="correzioni" role="switch" {{($listaprofili[0]->correzioni == '1') ? 'checked' : ''}} id="correzioni">
                                                        </div> 
                                                    </div>    
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="row mt-4">                                            
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h5 class="mb-1">Reso</h5>
                                                    </div>
                                                    <div class="col-4">                                                            
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input ms-auto" type="checkbox" name="reso" role="switch" {{($listaprofili[0]->reso == '1') ? 'checked' : ''}} id="reso">
                                                        </div> 
                                                    </div>    
                                                </div>  
                                            </div>                                            
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h5 class="mb-1">Preconto</h5>
                                                    </div>
                                                    <div class="col-4">                                                            
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input ms-auto" type="checkbox" name="preconto" role="switch" {{($listaprofili[0]->preconto == '1') ? 'checked' : ''}} id="preconto">
                                                        </div> 
                                                    </div>    
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="row mt-4">                                            
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h5 class="mb-1">Rapporti Fiscali</h5>
                                                    </div>
                                                    <div class="col-4">                                                            
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input ms-auto" type="checkbox" name="gestione_fiscale" role="switch" {{($listaprofili[0]->gestione_fiscale == '1') ? 'checked' : ''}} id="gestione_fiscale">
                                                        </div> 
                                                    </div>    
                                                </div>  
                                            </div>                                            
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h5 class="mb-1">Rapporti non Fiscali</h5>
                                                    </div>
                                                    <div class="col-4">                                                            
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input ms-auto" type="checkbox" name="rapporti" role="switch" {{($listaprofili[0]->rapporti == '1') ? 'checked' : ''}} id="rapporti">
                                                        </div> 
                                                    </div>    
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="row mt-4">                                            
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h5 class="mb-1">Stampa Fattura</h5>
                                                    </div>
                                                    <div class="col-4">                                                            
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input ms-auto" type="checkbox" name="fattura" role="switch" {{($listaprofili[0]->fattura == '1') ? 'checked' : ''}} id="fattura">
                                                        </div> 
                                                    </div>    
                                                </div>  
                                            </div>                                            
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h5 class="mb-1">Stampa Scontrini</h5>
                                                    </div>
                                                    <div class="col-4">                                                            
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input ms-auto" type="checkbox" name="scontrino" role="switch" {{($listaprofili[0]->scontrino == '1') ? 'checked' : ''}} id="scontrino">
                                                        </div> 
                                                    </div>    
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="row mt-4">                                            
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h5 class="mb-1">Scarico Prodotti</h5>
                                                    </div>
                                                    <div class="col-4">                                                            
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input ms-auto" type="checkbox" name="scarico" role="switch" {{($listaprofili[0]->scarico == '1') ? 'checked' : ''}} id="scarico">
                                                        </div> 
                                                    </div>    
                                                </div>  
                                            </div>                                            
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <!-- <h5 class="mb-1">Stampa Scontrini</h5> -->
                                                    </div>
                                                    <div class="col-4">                                                            
                                                        <div class="form-check form-switch mb-0">
                                                            <!-- <input class="form-check-input ms-auto" type="checkbox" name="scontrino" role="switch" {{($listaprofili[0]->scontrino == '1') ? 'checked' : ''}} id="scontrino"> -->
                                                        </div> 
                                                    </div>    
                                                </div>  
                                            </div>
                                        </div>
                                    </div>                                                                                                             
                                </div>    
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="saveprofilo">Modifica</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form action="{{@url('/profiloinsert')}}" enctype="multipart/form-data" id="profiloform" method="post">                            
                                <div class="card-body">
                                    {{csrf_field()}} 
                                    <div class="row">                                    
                                        <div class="col-4">
                                            <h5 class="mb-1">Codice</h5>
                                            <input class="form-control" type="text" maxlength="6" id="codice" name="codice" value="">
                                        </div>                                        
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-8">
                                            <h5 class="mb-1">Descrizione</h5>
                                            <input class="form-control" type="text" maxlength="25" required name="descrizione" id="descrizione" value="">
                                        </div>
                                    </div>                                      
                                </div>                                                            
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="saveprofilo">Inserisci</button>
                                    </div>
                                </div>
                            </form>
                        @endif    
                    </div>
                </div>
            </div>    
        </div>    
    </div>
</main>
<script>
    $(document).ready(function() {
        $('#lista').DataTable({
            "lengthMenu": [25, 50, 75, 100],
            "language": {
                "search": "Ricerca:",
                "lengthMenu": "_MENU_",
                "paginate": {
                    "first": "Prima",
                    "last": "Ultima",
                    "next": "Prossima",
                    "previous": "Precedente"
                },
                "infoFiltered": "(filtro su _MAX_ Profili totali)",
                "emptyTable": "Nessun Profilo trovato",
                "info": "Mostra da _START_ a _END_ su _TOTAL_ Profili",
                "infoEmpty": "Mostra 0 di 0 su 0 Profili",
            }
        });
    });
</script>