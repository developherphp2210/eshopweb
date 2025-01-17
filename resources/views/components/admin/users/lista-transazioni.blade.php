<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">                        
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="list"></i></div>
                            Lista Transazioni
                        </h1>                        
                    </div>
                    <div class="col-auto mb-3">                        
                        <h1 class="page-header-title">
                            <button class="btn btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i data-feather="filter"></i></button>
                            Filtri
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
    <hr class="mt-0 mb-4" />
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="lista" class="table table-striped table-sm " style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">Cassa</th>
                                <th class="text-center">Deposito</th>
                                <th class="text-center">Doc.</th>
                                <th class="text-center">Cassiere</th>
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Tessera</th>                                    
                                <th class="text-center">Prezzo</th>
                                <th class="text-center">Sconto</th>
                                <th class="text-center">Data</th>
                                <th class="text-center">Num. Scontrino</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transazioni['lista'] as  $lista)
                            <tr>
                                <td>{{$lista->cassa}}</td>
                                <td>{{$lista->deposito}}</td>
                                @switch($lista->causale_documento)
                                        @case('VC')
                                        <td class="text-center">S</td>
                                            @break
                                        @case('VE')
                                        <td class="text-center">C</td>
                                            @break
                                        @case('FA')
                                        <td class="text-center">F</td>
                                            @break                            
                                @endswitch                                
                                <td>{{$lista->operatore}}</td>
                                <td>{{$lista->cliente}}</td>
                                <td>{{$lista->tessera}}</td>
                                <td class="text-end">{{number_format($lista->importo, 2, ",", ".")}}</td>
                                <td class="text-end">{{number_format(($lista->sconti + $lista->offerte), 2, ",", ".")}}</td>                                 
                                <td class="text-center" data-search="{{$lista->data}}" data-order="{{date_timestamp_get(date_create($lista->data)) * 1000}}">{{date_format(date_create($lista->data),'d/m/Y H:i')}}</td>
                                @switch($lista->causale_documento)
                                        @case('VC')
                                            <td class="text-center">{{$lista->numero_scontrino}}</td>
                                            @break
                                        @case('VE')
                                        <td class="text-center">{{$lista->numero_scontrino}}</td>
                                            @break
                                        @case('FA')
                                        <td class="text-center">{{$lista->numero_fattura.'/'.$lista->registro_fattura}}</td>
                                            @break                            
                                @endswitch  
                                <td>
                                @switch($lista->causale_documento)
                                    @case('VC')
                                    <a title="Visualizza Scontrino"><button data-bs-toggle="modal" onclick="visualizzaSco({{$lista->id}})" data-bs-target="#VisualizzaScontrino" class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="clipboard"></i></button></a>
                                    @break
                                    @case('VE')
                                    <a title="Visualizza Scontrino"><button data-bs-toggle="modal" onclick="visualizzaSco({{$lista->id}})" data-bs-target="#VisualizzaScontrino" class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="clipboard"></i></button></a>
                                    @break
                                    @case('FA')
                                    <a title="Visualizza Fattura"><button data-bs-toggle="modal" onclick="visualizzaFat({{$lista->id}})" data-bs-target="#VisualizzaScontrino" class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="clipboard"></i></button></a>
                                    @break
                                @endswitch
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Filtri Ricerca</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <form action="/filtrilista" method="get" id="form_lista">    
    {{csrf_field()}}
    <div class="offcanvas-body">
        <div class="row">
            <div class="col-12">
                <input class="form-control" type="date" name="data" value="{{$transazioni['data']}}">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <select class="form-select" name="depositi" id="lista_depositi">                    
                    @foreach ($transazioni['depositi'] as $deposito)
                        <option {{($transazioni['default_dep'] == $deposito->id) ? 'selected' : ''}} value="{{$deposito->id}}">{{$deposito->codice.' - '.$deposito->descrizione}}</option>
                    @endforeach
                </select>
            </div>
        </div>    
        <div id="divcasse" class="row mt-3 {{($transazioni['default_dep'] == '0') ? 'd-none' : ''}}">
            <div class="col-12">
                <select class="form-select" name="casse" id="lista_casse">
                    @if($transazioni['default_dep'] != '0')
                        <option value="0">Tutte le Casse</option>
                        @foreach ($transazioni['casse'] as $cassa)
                            <option {{($transazioni['default_casse'] == $cassa->id) ? 'selected' : ''}} value="{{$cassa->id}}">{{$cassa->codice.' - '.$cassa->descrizione}}</option>
                        @endforeach    
                    @endif
                </select>
            </div>
        </div>    
    </div>
    <div class="offcanvas-footer">
        <div class="d-grid p-2">        
            <button class="btn btn-primary" type="submit">Applica Filtri</button>       
        </div>
    </div>
  </form>
</div>
<script>
    $(document).ready(function() {
        $('#lista').DataTable({
            "lengthMenu": [25, 50, 75, 100],
            "order": [[8, 'desc']],
            "language": {
                "search": "Ricerca:",
                "lengthMenu": "_MENU_",
                "paginate": {
                    "first": "Prima",
                    "last": "Ultima",
                    "next": "Prossima",
                    "previous": "Precedente"
                },
                "infoFiltered": "(filtro su _MAX_ Transazioni totali)",
                "emptyTable": "Nessuna Transazione trovata",
                "info": "Mostra da _START_ a _END_ su _TOTAL_ Transazioni",
                "infoEmpty": "Mostra 0 di 0 su 0 Transazioni",
            }
        });
    });
</script>
<!-- Modal -->
<div class="modal fade" id="VisualizzaScontrino" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="ModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card-body">
        <div class="row ">
            <div class="col-xl-12">
                <div class="p-2" id="corposcontrino">

                </div>
            </div>
        </div>
      </div>
      </div>      
    </div>
  </div>
</div>