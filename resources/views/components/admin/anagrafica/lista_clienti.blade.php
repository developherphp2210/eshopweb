<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Anagrafiche - Clienti / Fidelity Card
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container-xl px-4 mt-4">
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="lista" class="table table-striped table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>Tessera</th>
                                <th class="text-center">Nominativo</th>
                                <th class="text-center">Punti</th>
                                <th class="text-center">Prepagata</th>
                                <th class="text-center">Vendita</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clienti as $cliente)
                            <tr>
                                <td>{{$cliente->codice}}</td>
                                <td>{{$cliente->ragsoc}}</td>
                                <td class="text-center">{{$cliente->punti}}</td>
                                <td class="text-end">{{number_format($cliente->saldo, 2, ",", ".")}}</td>
                                <td class="text-end">{{number_format($cliente->totale_vendita, 2, ",", ".")}}</td>
                                <td class="text-center">
                                    <a title="Visualizza" href="{{url('/cliente/'.$cliente->id.'/1')}}"><button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="eye"></i></button></a>
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
            "columnDefs":[{orderable: false,
                targets: 5}],
            "language": {
                "search": "Ricerca:",
                "lengthMenu": "_MENU_",
                "paginate": {
                    "first": "Prima",
                    "last": "Ultima",
                    "next": "Prossima",
                    "previous": "Precedente"
                },
                "infoFiltered": "(filtro su _MAX_ Clienti totali)",
                "emptyTable": "Nessun Cliente trovato",
                "info": "Mostra da _START_ a _END_ su _TOTAL_ Clienti",
                "infoEmpty": "Mostra 0 di 0 su 0 Clienti",
            }
        });
    });
</script>