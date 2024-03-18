<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Anagrafiche - Reparti
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
                    <button type="button" id="addreparto" class="btn btn-primary">Aggiungi Reparto</button>
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
                            @foreach ($reparti as $reparto)
                            <tr onclick="schedaRep({{$reparto->id}})">
                                <td>{{$reparto->codice}}</td>
                                <td>{{$reparto->descrizione}}</td>
                                <td>
                                    <a title="Elimina" onclick="return confirm(`Sei sicuro di voler cancellare il Reparto {{$reparto->descrizione}} ? `)" href="{{url('/repartodelete/'.$reparto->id)}}">
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
                        @if($reparti->count() > 0)
                            <form action="{{@url('/repartoupdate/'.$reparti[0]->id)}}" enctype="multipart/form-data" id="repartoform" method="post">
                                <div class="card-body">                                
                                    {{csrf_field()}}
                                    <div class="row">                                    
                                        <div class="col-4">
                                            <h5 class="mb-1">Codice</h5>
                                            <input class="form-control" type="text" maxlength="6" id="codice" name="codice" value="{{$reparti[0]->codice}}">
                                        </div>
                                        <div class="col-8 d-flex justify-content-end">
                                            <h5 class="mb-1">Attivo</h5>
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input ms-auto" type="checkbox" name="attivo" role="switch" {{($reparti[0]->attivo == '1') ? 'checked' : ''}}  id="attivo">
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-8">
                                            <h5 class="mb-1">Descrizione</h5>
                                            <input class="form-control" type="text" maxlength="25" required name="descrizione" id="descrizione" value="{{$reparti[0]->descrizione}}">
                                        </div>
                                    </div>                                     
                                    <div class="row mt-4">
                                        <div class="col-4">
                                            <h5 class="mb-1">Posizione</h5>
                                            <input class="form-control" type="number" min=0  required name="posizione" id="posizione" value="{{$reparti[0]->posizione}}">
                                        </div>                                        
                                    </div>
                                </div>    
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="savereparto">Modifica</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form action="{{@url('/repartoinsert')}}" enctype="multipart/form-data" id="repartoform" method="post">                            
                                <div class="card-body">
                                    {{csrf_field()}} 
                                    <div class="row">                                    
                                        <div class="col-4">
                                            <h5 class="mb-1">Codice</h5>
                                            <input class="form-control" type="text" maxlength="6" id="codice" name="codice" value="">
                                        </div>
                                        <div class="col-8 d-flex justify-content-end">
                                            <h5 class="mb-1">Attivo</h5>
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input ms-auto" type="checkbox" name="attivo" checked role="switch" id="attivo">
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-8">
                                            <h5 class="mb-1">Descrizione</h5>
                                            <input class="form-control" type="text" maxlength="25" required name="descrizione" id="descrizione" value="">
                                        </div>
                                    </div>                                     
                                    <div class="row mt-4">
                                        <div class="col-4">
                                            <h5 class="mb-1">Posizione</h5>
                                            <input class="form-control" type="number" min=0  required name="posizione" id="posizione" value="">
                                        </div>                                        
                                    </div>   
                                </div>                                                            
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="savereparto">Inserisci</button>
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
                "infoFiltered": "(filtro su _MAX_ Reparti totali)",
                "emptyTable": "Nessun Reparto trovato",
                "info": "Mostra da _START_ a _END_ su _TOTAL_ Reparti",
                "infoEmpty": "Mostra 0 di 0 su 0 Reparti",
            }
        });
    });
</script>