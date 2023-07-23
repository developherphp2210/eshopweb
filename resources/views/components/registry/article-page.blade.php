<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Anagrafiche - Lista Articoli
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container-xl px-4 mt-4">
        <div class="card mb-4">
            <!-- <div class="card-header">Lista Articoli</div> -->
            <div class="card-body ">
                <div class="table-responsive">
                    <table id="lista" class="table table-striped table-sm " style="width:100%">
                        <thead>
                            <tr>
                                <th>Codice</th>
                                <th>Descrizione</th>
                                <th>Reparto</th>
                                <th>Prezzo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                            <tr>
                                <td>{{$article->code}}</td>
                                <td>{{$article->description}}</td>
                                <td>{{$article->department}}</td>
                                <td>{{number_format($article->price, 2, ",", ".")}}</td>
                                <td>
                                    <a title="Visualizza" href="{{url('/article/'.$article->id.'/1')}}"><button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="eye"></i></button></a>
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
                "infoFiltered": "(filtro su _MAX_ Articoli totali)",
                "emptyTable": "Nessun Articolo trovato",
                "info": "Mostra da _START_ a _END_ su _TOTAL_ Articoli",
                "infoEmpty": "Mostra 0 di 0 su 0 Articoli",
            }
        });
    });
</script>