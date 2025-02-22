<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Anagrafiche - Sconti
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
                    <button type="button" id="addsconto" class="btn btn-primary">Aggiungi Nuovo Sconto</button>
                </div>
                <div class="table-responsive">
                    <table id="lista" class="table table-hover table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>Codice</th>                                
                                <th>Descrizione</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listasconti as $sconto)
                            <tr onclick="schedaSco({{$sconto->id}})">                                
                                <td>{{$sconto->id}}</td>
                                <td>{{$sconto->descrizione}}</td>
                                <td>
                                    <a title="Elimina" onclick="return confirm(`Sei sicuro di voler cancellare lo Sconto {{$sconto->descrizione}} ? `)" href="{{url('/scontodelete/'.$sconto->id)}}">
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
                        @if($listasconti->count() > 0)
                            @php                            
                               $lastid = session('lastid');                          
                               $sco = $listasconti->filter( function( $value,int $key) use($lastid) {
                                    if ($value->id == $lastid){
                                        return $value;
                                    }
                                })->first();                                                                                                                                                                                                                                                     
                            @endphp 
                            <form action="{{@url('/scontoupdate/'.$sco->id)}}" enctype="multipart/form-data" id="scontoform" method="post">
                                <div class="card-body">                                
                                    {{csrf_field()}}
                                    <div class="row mt-4">
                                        <div class="col-4">
                                            <h5 class="mb-1">Codice</h5>
                                            <input class="form-control" type="text" readonly id="id" name="id" value="{{$sco->id}}">
                                        </div>
                                        <div class="col-8 d-flex justify-content-end">
                                            <h5 class="mb-1">Attivo</h5>
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input ms-auto" type="checkbox" name="attivo" role="switch" {{($sco->attivo == '1') ? 'checked' : ''}}  id="attivo">
                                            </div>   
                                        </div>
                                    </div>                                    
                                    <div class="row mt-4">
                                        <div class="col-8">
                                            <h5 class="mb-1">Descrizione</h5>
                                            <input class="form-control" type="text" maxlength="25" required name="descrizione" id="descrizione" value="{{$sco->descrizione}}">
                                        </div>                                        
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <h5 class="mb-1">Tipologia di Sconto</h5>
                                            <select class="form-select mb-3" required name="tipo" id="tipo"> 
                                                <option >Seleziona una tipologia di Sconto</option>                                            
                                                <option {{( $sco->tipo == 1) ? 'selected' : ''}} value="1">Sconto in %</option>
                                                <option {{( $sco->tipo == 2) ? 'selected' : ''}} value="2">Sconto in Ammontare</option>                                            
                                            </select>
                                        </div>    
                                        <div class="col-6">
                                            <h5 class="mb-1">Valore Sconto</h5>
                                            <input class="form-control" type="number" required name="valore" id="valore" value="{{$sco->valore}}">
                                        </div>
                                    </div>                                                                         
                                </div>    
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="savesconto">Salva</button>
                                    </div>
                                </div>
                            </form>
                            @php
                                session()->forget('lastid');
                            @endphp
                        @else
                            <form action="{{@url('/scontoinsert')}}" enctype="multipart/form-data" id="scontoform" method="post">                            
                                <div class="card-body">
                                    {{csrf_field()}}                                     
                                    <div class="row mt-4">
                                        <div class="col-8">
                                            <h5 class="mb-1">Descrizione</h5>
                                            <input class="form-control" type="text" maxlength="25" required name="descrizione" id="descrizione" value="">
                                        </div>
                                        <div class="col-4 d-flex justify-content-end">
                                            <h5 class="mb-1">Attivo</h5>
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input ms-auto" type="checkbox" name="attivo" checked role="switch" id="attivo">
                                            </div>   
                                        </div>
                                    </div>                                     
                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <h5 class="mb-1">Tipologia di Sconto</h5>
                                            <select class="form-select mb-3" required name="tipo" id="tipo">
                                                <option value="0">Seleziona una tipologia di Sconto</option>                                            
                                                <option value="1">Sconto in %</option>
                                                <option value="2">Sconto in Ammontare</option>                                            
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-1">Valore Sconto</h5>
                                            <input class="form-control" type="number" required name="valore" id="valore" >
                                        </div>    
                                    </div>
                                </div>                                                            
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="savesconto">Inserisci</button>
                                    </div>
                                </div>
                            </form>
                        @endif                        
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
                "infoFiltered": "(filtro su _MAX_ Sconti totali)",
                "emptyTable": "Nessun Sconto trovato",
                "info": "Mostra da _START_ a _END_ su _TOTAL_ Sconti",
                "infoEmpty": "Mostra 0 di 0 su 0 Sconti",
            }
        });
    });
</script>