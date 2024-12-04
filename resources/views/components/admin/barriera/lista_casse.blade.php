<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="monitor"></i></div>
                            Barriera Casse - Lista Casse
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
                    <button type="button" id="addcassa" class="btn btn-primary">Aggiungi Cassa</button>
                </div>
                <div class="table-responsive">
                    <table id="lista" class="table table-hover table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>Codice</th>
                                <th>Descrizione</th>
                                <th>Deposito</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listacasse['casse'] as $cassa)
                            <tr onclick="schedaCas({{$cassa->id}})">
                                <td>{{$cassa->codice}}</td>
                                <td>{{$cassa->descrizione}}</td>
                                <td>{{$cassa->codep.' - '.$cassa->deposito}}</td>
                                <td>
                                    <a title="Elimina" onclick="return confirm(`Sei sicuro di voler cancellare la Cassa {{$cassa->descrizione}} ? `)" href="{{url('/cassadelete/'.$cassa->id)}}">
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
                        @if($listacasse['casse']->count() > 0)
                            <form action="{{@url('/cassaupdate/'.$listacasse['casse'][0]->id)}}" enctype="multipart/form-data" id="cassaform" method="post">
                                <div class="card-body">                                
                                    {{csrf_field()}}
                                    <div class="row">                                    
                                        <div class="col-4">
                                            <h5 class="mb-1">Codice</h5>
                                            <input class="form-control" type="text" maxlength="6" id="codice" name="codice" value="{{$listacasse['casse'][0]->codice}}">
                                        </div>                                        
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-8">
                                            <h5 class="mb-1">Descrizione</h5>
                                            <input class="form-control" type="text" maxlength="20" required name="descrizione" id="descrizione" value="{{$listacasse['casse'][0]->descrizione}}">
                                        </div>
                                    </div>                                                                                                             
                                    <div class="row mt-4">
                                        <div class="col-8">
                                            <h5 class="mb-1">Deposito</h5>
                                            <select class="form-select mb-3" required name="id_deposito" id="id_deposito">
                                                <option selected value="">Seleziona un Deposito</option>
                                                @foreach ($listacasse['deposito'] as $deposito)
                                                <option {{($deposito->id == $listacasse['casse'][0]->id_deposito) ? 'selected' : ''}} value="{{$deposito->id}}">{{$deposito->descrizione}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="savecassa">Salva</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form action="{{@url('/cassainsert')}}" enctype="multipart/form-data" id="cassaform" method="post">                            
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
                                            <input class="form-control" type="text" maxlength="20" required name="descrizione" id="descrizione" value="">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-8">
                                            <h5 class="mb-1">Deposito</h5>
                                            <select class="form-select mb-3" required name="id_deposito" id="id_deposito">
                                                <option selected value="">Seleziona un Deposito</option>
                                                @foreach ($listacasse['deposito'] as $deposito)
                                                <option value="{{$deposito->id}}">{{$deposito->descrizione}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>                                                                                                         
                                </div> 
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="savecassa">Inserisci</button>
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
                "infoFiltered": "(filtro su _MAX_ Casse totali)",
                "emptyTable": "Nessuna Cassa trovata",
                "info": "Mostra da _START_ a _END_ su _TOTAL_ Casse",
                "infoEmpty": "Mostra 0 di 0 su 0 Casse",
            }
        });
    });
</script>