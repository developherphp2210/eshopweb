<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Lista Utenti
                        </h1>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="lista" class="table table-striped table-sm " style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">Nome Azienda</th>
                                <th class="text-center">E-mail</th>
                                <th class="text-center">Ragione Sociale</th>
                                <th class="text-center">P. Iva</th>
                                <th>Data Creazione</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userslist as $user)
                            <tr>
                                <td>{{$user->user_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->business_name}}</td>
                                <td>{{$user->piva}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    <a title="Visualizza" href="{{url('/admin/user/'.$user->id)}}"><button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="eye"></i></button></a>
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
                "infoFiltered": "(filtro su _MAX_ Utenti totali)",
                "emptyTable": "Nessun Utente trovato",
                "info": "Mostra da _START_ a _END_ su _TOTAL_ Utenti",
                "infoEmpty": "Mostra 0 di 0 su 0 Utenti",
            }
        });
    });
</script>