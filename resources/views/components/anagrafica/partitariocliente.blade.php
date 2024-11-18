<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Anagrafica Cliente - {{$cliente['anagrafica']->ragsoc}}
                        </h1>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link  ms-0" href="{{url('/cliente/'.$cliente['anagrafica']->id.'/1')}}">Anagrafica Cliente</a>
            <a class="nav-link active" href="{{url('/cliente/'.$cliente['anagrafica']->id.'/2')}}">Partitario</a>
            <a class="nav-link" href="{{url('/cliente/'.$cliente['anagrafica']->id.'/3')}}">Tessere Fidelity</a>
        </nav>
        <hr class="mt-0 mb-4" />
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="lista" class="table table-striped table-sm " style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">Cassa</th>
                                <th class="text-center">Deposito</th>
                                <th class="text-center">Doc. Comm.</th>
                                <th class="text-center">Cassiere</th>
                                <th class="text-center">Prezzo</th>
                                <th class="text-center">Sconto</th>
                                <th class="text-center">Data</th>
                                <th class="text-center">Num. Scontrino</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cliente['transazioni'] as $lista)
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
                                <td class="text-end">{{number_format($lista->importo, 2, ",", ".")}}</td>
                                <td class="text-end">{{number_format($lista->sconti, 2, ",", ".")}}</td>                                 
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
                                    <a title="Visualizza Scontrino"><button data-bs-toggle="modal" onclick="visualizzaFat({{$lista->id}})" data-bs-target="#VisualizzaScontrino" class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="clipboard"></i></button></a>
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
<script>
    $(document).ready(function() {
        $('#lista').DataTable({
            "lengthMenu": [25, 50, 75, 100],
            "order": [[6, 'desc']],
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