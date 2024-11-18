<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="credit-card"></i></div>
                            Fidelity Card non Associate
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
                                <th>Punti</th>                                
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>                           
                            @foreach ($lista['fidelity'] as $card)
                            <tr>
                                <td>{{$card->codice}}</td>                                
                                <td class="text-center">{{$card->punti}}</td>                                
                                <td class="text-end">
                                    <a title="Associa Cliente Fidelity" ><button data-bs-toggle="modal" data-bs-target="#FidelityModal" class="btn btn-datatable btn-icon btn-transparent-dark" onclick="openfidelitymodal({{$card->id}})" ><i data-feather="plus"></i></button></a>
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
                "infoFiltered": "(filtro su _MAX_ Fidelity totali)",
                "emptyTable": "Nessuna Fidelity trovata",
                "info": "Mostra da _START_ a _END_ su _TOTAL_ Fidelity",
                "infoEmpty": "Mostra 0 di 0 su 0 Fidelity",
            }
        });
    });
</script>

<div class="modal fade" id="FidelityModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Lista Clienti</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/associafidelity" method="post" id="formfidelity">
        {{csrf_field()}}    
            <input type="hidden" name="fidelityid" id="fidelityID">
            <input type="hidden" name="clienteid" id="clienteID">
        </form>        
            <table id="listacli" class="table table-striped table-sm" style="width: 100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Citta</th>
                        <th>Email</th>        
                        <th></th>                
                    </tr>
                </thead>
                <tbody>
                @foreach($lista['clienti'] as $cliente) 
                    <tr>
                        <td>{{$cliente->ragsoc}}</td>
                        <td>{{$cliente->citta}}</td>
                        <td>{{$cliente->email}}</td>
                        <td class="text-center"><a title="Collega Fidelity al Cliente"><button type="button" class="btn btn-sm" onclick="associaclientefidelity({{$cliente->id}})"><i data-feather="link"></i></button></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>                
      </div>
      <script>
        $(document).ready(function() {
            $('#listacli').DataTable({
                "lengthMenu": [15, 50, 75, 100],
                "language": {
                    "search": "Ricerca:",
                    "lengthMenu": "_MENU_",
                    "paginate": {
                        "first": "Prima",
                        "last": "Ultima",
                        "next": "Prossima",
                        "previous": "Precedente"
                    },
                    "infoFiltered": "(filtro su _MAX_ Fidelity totali)",
                    "emptyTable": "Nessuna Fidelity trovata",
                    "info": "Mostra da _START_ a _END_ su _TOTAL_ Fidelity",
                    "infoEmpty": "Mostra 0 di 0 su 0 Fidelity",
                }
            });
        });
    </script>  
    </div>    
  </div>
</div>