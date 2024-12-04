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
            <a class="nav-link" href="{{url('/cliente/'.$cliente['anagrafica']->id.'/2')}}">Partitario</a>
            <a class="nav-link active" href="{{url('/cliente/'.$cliente['anagrafica']->id.'/3')}}">Tessere Fidelity</a>
        </nav>
        <hr class="mt-0 mb-4" />
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="lista" class="table table-striped table-sm " style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">Tessera</th>
                                <th class="text-center">Descrizione</th>                                
                                <th class="text-center">Punti</th>
                                <th class="text-center">Saldo Prepagata</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cliente['fidelity'] as $fidelity)
                                <tr>
                                    <th>{{$fidelity->codice}}</th>
                                    <th>{{$fidelity->descrizione}}</th>
                                    <th class="text-center">{{$fidelity->punti}}</th>
                                    <th class="text-end">{{number_format($fidelity->saldo, 2, ",", ".")}}</th>
                                    <th></th>
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
            "language": {
                "search": "Ricerca:",
                "lengthMenu": "_MENU_",
                "paginate": {
                    "first": "Prima",
                    "last": "Ultima",
                    "next": "Prossima",
                    "previous": "Precedente"
                },
                "infoFiltered": "(filtro su _MAX_ Tessere totali)",
                "emptyTable": "Nessuna Tessera trovata",
                "info": "Mostra da _START_ a _END_ su _TOTAL_ Tessere",
                "infoEmpty": "Mostra 0 di 0 su 0 Tessere",
            }
        });
    });
</script>