<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Lista Tessere Fidelity
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
            <div class="card-header d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddFidelity">Collega la tua Fidelity Card</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="lista" class="table table-striped table-sm " style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">Tessera</th>
                                <th class="text-center">Descrizione</th>                                
                                <th class="text-center">Punti</th>
                                <th class="text-center">Saldo Prepagata</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listafidelity as $fidelity)
                                <tr>
                                    <th>{{$fidelity->codice}}</th>
                                    <th>{{$fidelity->descrizione}}</th>
                                    <th class="text-center">{{$fidelity->punti}}</th>
                                    <th class="text-end">{{number_format($fidelity->saldo, 2, ",", ".")}}</th>                                    
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

<div class="modal fade" id="AddFidelity" tabindex="-1" aria-labelledby="AddFidelityLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="AddFidelityLabel">Collega la tua Fidelity CARD</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{@url('/addfidelity')}}" enctype="multipart/form-data" method="post" >
      {{csrf_field()}} 
        <div class="modal-body">        
                <div class="row">
                    <div class="col-8">
                        <label for="codice">Codice Tessera</label>
                        <input type="text" id="codice" name="codice" maxlength="13" class="form-control">
                    </div>                
                </div>                
        </div>
        <div class="modal-footer">        
            <button type="submit" class="btn btn-primary">Collega</button>
        </div>
      </form>
    </div>
  </div>
</div>