<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Anagrafiche - Aliquote Iva
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
                                <th>Codice</th>
                                <th>Descrizione</th>
                                <th>Aliquota</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($aliquote as $iva)
                            <tr>
                                <td>{{$iva->codice}}</td>
                                <td>{{$iva->descrizione}}</td>
                                <td>{{$iva->aliquota}}</td>
                                <td class="text-end"><a title="Modifica Aliquota" href="/ivashow/{{$iva->id}}" ><i data-feather="edit"></i></a></td>
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
                "infoFiltered": "(filtro su _MAX_ Aliquote totali)",
                "emptyTable": "Nessun Aliquota trovato",
                "info": "Mostra da _START_ a _END_ su _TOTAL_ Aliquote",
                "infoEmpty": "Mostra 0 di 0 su 0 Aliquote",
            }
        });
    });
</script>