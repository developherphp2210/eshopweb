<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="book-open"></i></div>
                            Volantini PDF
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container-xl px-4 mt-4">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddVolantino">Aggiungi nuovo Volantino</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="lista" class="table table-striped table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nome</th>                                
                                <th>Deposito</th>                                
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>                           
                            @foreach ($lista as $vol)
                            <tr>
                                <td>{{$vol->nome}}</td>                                
                                <td class="text-center">{{$vol->deposito}}</td>                                
                                <td class="text-end">                                   
                                    <a title="Visualizza Volantino" href="{{url('/volantinopdfshow/'.$vol->id)}}">
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="eye"></i></button> 
                                    </a>
                                </td>
                                <td class="text-end">                                
                                    <a title="Elimina" onclick="return confirm(`Sei sicuro di voler cancellare il Volantino {{$vol->nome}} ? `)" href="{{url('/volantinopdfdelete/'.$vol->id)}}">
                                            <button class="btn btn-datatable btn-icon btn-transparent-dark"><i style="color:red" data-feather="trash-2"></i></button>
                                    </a>                                
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
                targets: 2},
            {orderable:false,
                targets:3
            }],
            "language": {
                "search": "Ricerca:",
                "lengthMenu": "_MENU_",
                "paginate": {
                    "first": "Prima",
                    "last": "Ultima",
                    "next": "Prossima",
                    "previous": "Precedente"
                },
                "infoFiltered": "(filtro su _MAX_ Volantini totali)",
                "emptyTable": "Nessun Volantino trovato",
                "info": "Mostra da _START_ a _END_ su _TOTAL_ Volantini",
                "infoEmpty": "Mostra 0 di 0 su 0 Volantini",
            }
        });
    });
</script>

<div class="modal fade" id="AddVolantino" tabindex="-1" aria-labelledby="AddVolantinoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="AddVolantinoLabel">Importa Nuovo Volantino PDF</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{@url('/volantinopdfinsert')}}" enctype="multipart/form-data" method="post" >
      {{csrf_field()}} 
        <div class="modal-body">        
                <div class="row">
                    <div class="col-8">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" class="form-control">
                    </div>                
                </div>
                <div class="row mt-3">
                    <div class="col-8">
                        <label for="depositi">Deposito</label>
                        <select class="form-control" name="id_deposito" id="deposito">
                            @foreach($depositi as $deposito)
                                <option value="{{$deposito->id}}">{{$deposito->codice.' - '.$deposito->descrizione}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label for="path">File</label>
                        <input type="file" id="path" name="path" class="form-control">
                    </div>
                </div>        
        </div>
        <div class="modal-footer">        
            <button type="submit" class="btn btn-primary">Memorizza</button>
        </div>
      </form>
    </div>
  </div>
</div>