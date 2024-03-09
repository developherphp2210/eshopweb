<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Anagrafica Cliente - {{$customer->ragsoc}}
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
            <a class="nav-link ms-0" href="{{url('/customer/'.$customer->id.'/1')}}">Anagrafica Cliente</a>
            <a class="nav-link active" href="{{url('/customer/'.$customer->id.'/2')}}">Partitario</a>
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
                                <th class="text-center">Cassiere</th>
                                <th class="text-center">Prezzo</th>
                                <th class="text-center">Sconto</th>
                                <th class="text-center">Data</th>
                                <th class="text-center">Numero Transazione</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ledgers as $ledger)
                            <tr>
                                <td>{{$ledger->cassa}}</td>
                                <td>{{$ledger->deposito}}</td>
                                <td>{{$ledger->cassiere}}</td>
                                <td class="text-end">{{number_format($ledger->amount, 2, ",", ".")}}</td>
                                <td class="text-end">{{number_format($ledger->discount, 2, ",", ".")}}</td>
                                <td class="text-center">{{$ledger->data}}</td>
                                <td class="text-end">{{$ledger->transaction_number}}</td>
                                <td>
                                    <a title="Visualizza" href="{{url('/receiptuser/'.$ledger->id)}}"><button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="eye"></i></button></a>
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
                "emptyTable": "Nessuna Transazione trovato",
                "info": "Mostra da _START_ a _END_ su _TOTAL_ Transazioni",
                "infoEmpty": "Mostra 0 di 0 su 0 Transazioni",
            }
        });
    });
</script>