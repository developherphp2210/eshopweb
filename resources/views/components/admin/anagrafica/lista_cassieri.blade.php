<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Anagrafiche - Lista Cassieri
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
                    <button type="button" id="addcassiere" class="btn btn-primary">Aggiungi un Cassiere</button>
                </div>
                <div class="table-responsive">
                    <table id="lista" class="table table-hover table-sm" style="width:100%">
                        <thead>
                            <tr>                                
                                <th>Descrizione</th>
                                <th>Profilo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listacassieri['cassieri'] as $cassiere)
                            <tr onclick="schedaCas({{$cassiere->id}})">                                
                                <td>{{$cassiere->descrizione}}</td>
                                <td>{{$cassiere->profilo}}</td>
                                <td>
                                    <a title="Elimina" onclick="return confirm(`Sei sicuro di voler cancellare il Cassiere {{$cassiere->descrizione}} ? `)" href="{{url('/cassieredelete/'.$cassiere->id)}}">
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
                        @if($listacassieri['cassieri']->count() > 0)
                            @php                            
                               $lastid = session('lastid');                                                         
                               $cassieri = $listacassieri['cassieri']->filter( function( $value,int $key) use($lastid) {
                                    if ($value->id == $lastid){
                                        return $value;
                                    }
                                })->first();                                                                                                                                                                                                                                                     
                            @endphp
                            <form action="{{@url('/cassiereupdate/'.$cassieri->id)}}" enctype="multipart/form-data" id="cassiereform" method="post">
                                <div class="card-body">                                
                                    {{csrf_field()}}                                    
                                    <div class="row mt-4">
                                        <div class="col-8">
                                            <h5 class="mb-1">Descrizione</h5>
                                            <input class="form-control" type="text" maxlength="25" required name="descrizione" id="descrizione" value="{{$cassieri->descrizione}}">
                                        </div>
                                        <div class="col-4 d-flex justify-content-end">
                                            <h5 class="mb-1">Attivo</h5>
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input ms-auto" type="checkbox" name="attivo" role="switch" {{($cassieri->attivo == '1') ? 'checked' : ''}}  id="attivo">
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <h5 class="mb-1">Password</h5>
                                            <input class="form-control" type="password" {{($cassieri->visibile_frontend == '1') ? 'readonly' : ''}} maxlength="255" required name="password" id="password" value="{{$cassieri->password}}">
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-1">Barcode</h5>
                                            <input class="form-control" type="text" maxlength="13"  name="barcode" id="barcode" value="{{$cassieri->barcode}}">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-6 d-flex ">
                                            <h5 class="mb-1">Visibile in Cassa</h5>
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input ms-auto" type="checkbox" name="visibile_cassa" role="switch" {{($cassieri->visibile_cassa == '1') ? 'checked' : ''}}  id="visibile_cassa">
                                            </div>   
                                        </div>
                                        <div class="col-6 d-flex ">
                                            <h5 class="mb-1">Visibile su FrontEnd</h5>
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input ms-auto" type="checkbox" name="visibile_frontend" {{($cassieri->visibile_frontend == '1') ? 'disabled' : ''}} role="switch" {{($cassieri->visibile_frontend == '1') ? 'checked' : ''}}  id="visibile_frontend">
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <h5 class="mb-1">Profilo Operatore</h5>
                                            <select class="form-select mb-3" required name="id_profilo" id="id_profilo">
                                            <option value="">Seleziona un Profilo</option>
                                                @foreach ($listacassieri['profili'] as $profilo)
                                                <option {{( $cassieri->id_profilo == $profilo->id) ? 'selected' : ''}} value="{{$profilo->id}}">{{$profilo->descrizione}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-1">Deposito</h5>
                                            <select class="form-select mb-3" required name="id_deposito" id="id_deposito">
                                                <option value="0">Tutti i Depositi</option>
                                                @foreach ($listacassieri['depositi'] as $deposito)
                                                <option value="{{$deposito->id}}">{{$deposito->descrizione}}</option>
                                                @endforeach
                                            </select>
                                        </div>     
                                    </div>                                                                         
                                </div>    
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="savecassiere">Salva</button>
                                    </div>
                                </div>
                            </form>
                            @php
                                session()->forget('lastid');
                            @endphp
                        @else
                            <form action="{{@url('/cassiereinsert')}}" enctype="multipart/form-data" id="cassiereform" method="post">                            
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
                                            <h5 class="mb-1">Password</h5>
                                            <input class="form-control" type="password" maxlength="255" required name="password" id="password" value="">
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-1">Barcode</h5>
                                            <input class="form-control" type="text" maxlength="13"  name="barcode" id="barcode" value="">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-6 d-flex ">
                                            <h5 class="mb-1">Visibile in Cassa</h5>
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input ms-auto" type="checkbox" name="visibile_cassa" role="switch" id="visibile_cassa">
                                            </div>   
                                        </div>
                                        <div class="col-6 d-flex ">
                                            <h5 class="mb-1">Visibile su FrontEnd</h5>
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input ms-auto" type="checkbox" name="visibile_frontend" role="switch" id="visibile_frontend">
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <h5 class="mb-1">Profilo Operatore</h5>
                                            <select class="form-select mb-3" required name="id_profilo">
                                                <option selected value="">Seleziona un Profilo</option>
                                                @foreach ($listacassieri['profili'] as $profilo)
                                                <option value="{{$profilo->id}}">{{$profilo->descrizione}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-1">Deposito</h5>
                                            <select class="form-select mb-3" required name="id_deposito">                                                
                                                @foreach ($listacassieri['depositi'] as $deposito)
                                                <option value="{{$deposito->id}}">{{$deposito->descrizione}}</option>
                                                @endforeach
                                            </select>
                                        </div>        
                                    </div>  
                                </div>                                                            
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="savecassiere">Inserisci</button>
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
                "infoFiltered": "(filtro su _MAX_ Cassieri totali)",
                "emptyTable": "Nessun Cassiere trovato",
                "info": "Mostra da _START_ a _END_ su _TOTAL_ Cassieri",
                "infoEmpty": "Mostra 0 di 0 su 0 Cassieri",
            }
        });
    });
</script>