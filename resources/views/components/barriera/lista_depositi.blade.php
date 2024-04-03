<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="monitor"></i></div>
                            Barriera Casse - Lista Depositi
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="px-4 mt-4">
        <div class="row g-4 g-xl-6">
            <div class="col-xl-5 col-xxl-5">
                <!-- <div class="p-1 mb-2">
                    <button type="button" id="addcausale" class="btn btn-primary">Aggiungi Causale</button>
                </div> -->
                <div class="table-responsive">
                    <table id="listadeposito" class="table table-hover table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>Codice</th>
                                <th>Descrizione</th>
                                <!-- <th></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listadepositi['deposito'] as $deposito)
                            <tr onclick="schedaDep({{$deposito->id}})">
                                <td>{{$deposito->codice}}</td>
                                <td>{{$deposito->descrizione}}</td>
                                <!-- <td>
                                    <a title="Elimina" onclick="return confirm(`Sei sicuro di voler cancellare il Deposito {{$deposito->descrizione}} ? `)" href="{{url('/depositodelete/'.$deposito->id)}}">
                                            <button class="btn btn-datatable btn-icon btn-transparent-dark"><i style="color:red" data-feather="trash-2"></i></button>
                                    </a>
                                </td> -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        <div class="col-xl-7 col-xxl-7 p-4">
            <div class="sticky-leads-sidebar">
                <div class="card mb-4">                            
                        @if($listadepositi['deposito']->count() > 0)
                            <form action="{{@url('/depositoupdate/'.$listadepositi['deposito'][0]->id)}}" enctype="multipart/form-data" id="depositoform" method="post">
                                <div class="card-body">                                
                                    {{csrf_field()}}
                                    <div class="row">                                    
                                        <div class="col-4">
                                            <h5 class="mb-1">Codice</h5>
                                            <input class="form-control" type="text" maxlength="6" id="codice" name="codice" value="{{$listadepositi['deposito'][0]->codice}}">
                                        </div>                                        
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-8">
                                            <h5 class="mb-1">Descrizione</h5>
                                            <input class="form-control" type="text" maxlength="25" required name="descrizione" id="descrizione" value="{{$listadepositi['deposito'][0]->descrizione}}">
                                        </div>
                                    </div>                                                                                                             
                                    <div class="row mt-4">
                                        <div>
                                            <h5 class="mb-1">Listino Associato</h5>
                                            <select class="form-select mb-3" required name="id_listino" id="id_listino">
                                                <option selected value="">Seleziona un Listino</option>
                                                @foreach ($listadepositi['listino'] as $tlistino)
                                                <option {{($tlistino->id == $listadepositi['deposito'][0]->id_listino) ? 'selected' : ''}} value="{{$tlistino->id}}">{{$tlistino->descrizione}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>                                
                                <!-- <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="savedeposito">Salva</button>
                                    </div>
                                </div> -->
                            </form>
                        @else
                            <form action="{{@url('/depositoinsert')}}" enctype="multipart/form-data" id="depositoform" method="post">                            
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
                                <!-- <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="savedeposito">Inserisci</button>
                                    </div>
                                </div> -->
                            </form>
                        @endif                        
                </div>
            </div>    
        </div>    
    </div>
</main>
<script>
    $(document).ready(function() {
        $('#listadeposito').DataTable({
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
                "infoFiltered": "(filtro su _MAX_ Depositi totali)",
                "emptyTable": "Nessun Deposito trovato",
                "info": "Mostra da _START_ a _END_ su _TOTAL_ Depositi",
                "infoEmpty": "Mostra 0 di 0 su 0 Depositi",
            }
        });
    });
</script>