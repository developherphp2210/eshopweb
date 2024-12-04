<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="gift"></i></div>
                            Raccolta Punti
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
                    <button type="button" id="addpromo" class="btn btn-primary">Aggiungi Raccolta Punti</button>
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
                            @foreach ($promozioni as $promo)
                            <tr onclick="schedaPromo({{$promo->id}})">
                                <td>{{$promo->id}}</td>
                                <td>{{$promo->descrizione}}</td>  
                                <td>
                                    <a title="Elimina" onclick="return confirm(`Sei sicuro di voler cancellare la Promo {{$promo->descrizione}} ? `)" href="{{url('/promodelete/'.$promo->id)}}">
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
                        @if($promozioni->count() > 0)
                            <form action="{{@url('/promoupdate/'.$aliquote[0]->id)}}" enctype="multipart/form-data" id="promoform" method="post">
                                <div class="card-body">                                
                                    {{csrf_field()}}
                                    <div class="row">                                    
                                        <div class="col-4">
                                            <h5 class="mb-1">Codice</h5>
                                            <input class="form-control" type="text" readonly maxlength="6" id="id" name="id" value="{{$promozioni[0]->id}}">
                                        </div>
                                        <div class="col-8">
                                            <h5 class="mb-1">Deposito</h5>
                                            <select class="form-control" name="id_deposito" id="id_deposito">                                                      
                                                @foreach($depositi as $deposito)
                                                    <option value="{{$deposito->id}}" {{($deposito->id == $promozioni[0]->id_deposito) ? 'selected' : ''}}>{{$deposito->descrizione}}</option>
                                                @endforeach
                                            </select>                                            
                                        </div>                                                                                
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-8">
                                            <h5 class="mb-1">Descrizione</h5>
                                            <input class="form-control" type="text" maxlength="25" required name="descrizione" id="descrizione" value="{{$promozioni[0]->descrizione}}">
                                        </div>
                                    </div>                                     
                                    <div class="row mt-4">
                                        <div class="col-4">
                                            <h5 class="mb-1">Data Inizio</h5>
                                            <input class="form-control" type="date" required name="data_inizio" id="data_inizio" value="{{$promozioni[0]->data_inizio}}">
                                        </div>
                                        <div class="col-4">
                                            <h5 class="mb-1">Data Fine</h5>
                                            <input class="form-control" type="date" required name="data_fine" id="data_fine" value="{{$promozioni[0]->data_fine}}">
                                        </div>
                                    </div>
                                </div>    
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="savepromo">Salva</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form action="{{@url('/promoinsert')}}" enctype="multipart/form-data" id="promoform" method="post">                            
                                <div class="card-body">
                                    {{csrf_field()}}    
                                    <div class="row">                                                                            
                                        <div class="col-8">
                                            <h5 class="mb-1">Deposito</h5>
                                            <select class="form-control" name="id_deposito" id="id_deposito">                                                     
                                                @foreach($depositi as $deposito)
                                                    <option value="{{$deposito->id}}">{{$deposito->descrizione}}</option>
                                                @endforeach
                                            </select>                                            
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
                                            <h5 class="mb-1">Data Inizio</h5>
                                            <input class="form-control" type="date" min=0  required name="data_inizio" id="data_inizio" value="">
                                        </div>
                                        <div class="col-4">
                                            <h5 class="mb-1">Data Fine</h5>
                                            <input class="form-control" type="date" min="1" required name="data_fine" id="data_fine" value="">
                                        </div>
                                    </div>
                                </div>                                                            
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="savepromo">Inserisci</button>
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
                "infoFiltered": "(filtro su _MAX_ Promozioni totali)",
                "emptyTable": "Nessuna Promozione trovata",
                "info": "Mostra da _START_ a _END_ su _TOTAL_ Promozioni",
                "infoEmpty": "Mostra 0 di 0 su 0 Promozioni",
            }
        });
    });
</script>