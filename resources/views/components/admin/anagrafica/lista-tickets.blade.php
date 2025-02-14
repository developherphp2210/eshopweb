<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Anagrafiche - Tickets / Buoni Pasto
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="px-4 mt-4">
        <div class="row g-4 g-xl-6">
            <div class="col-xl-5 col-xxl-5">
                <div class="p-1 mb-2">
                    <button type="button" id="addticket" class="btn btn-primary">Aggiungi Ticket / Buono Pasto</button>
                </div>
                <div class="table-responsive">
                    <table id="lista" class="table table-hover table-sm" style="width:100%">
                        <thead>
                            <tr> 
                                <th>Codice</th>                                                              
                                <th>Descrizione</th>
                                <th>Valore</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listatickets as $ticket)
                            <tr onclick="schedaTic({{$ticket->id}})">                                
                                <td>{{$ticket->id}}</td>
                                <td>{{$ticket->descrizione}}</td>
                                <td>€ {{number_format($ticket->valore, 2, ",", ".")}}</td>
                                <td>
                                    @if ($ticket->id > 1)
                                    <a title="Elimina" onclick="return confirm(`Sei sicuro di voler cancellare il Ticket {{$ticket->descrizione}} ? `)" href="{{url('/ticketdelete/'.$ticket->id)}}">
                                            <button class="btn btn-datatable btn-icon btn-transparent-dark"><i style="color:red" data-feather="trash-2"></i></button>
                                    </a>                                    
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        <div class="col-xl-7 col-xxl-7 p-4">
            <div class="sticky-leads-sidebar">
                <div class="card mb-4">                            
                        @if($listatickets->count() > 0)
                            @php                            
                               $lastid = session('lastid');                          
                               $tickets = $listatickets->filter( function( $value,int $key) use($lastid) {
                                    if ($value->id == $lastid){
                                        return $value;
                                    }
                                })->all();                                                                                                                                                                                                                                                      
                            @endphp
                            @foreach( $tickets as $ticket)
                            <form action="{{@url('/ticketupdate/'.$ticket->id)}}" enctype="multipart/form-data" id="ticketform" method="post">
                                <div class="card-body">                                
                                    {{csrf_field()}}
                                    <div class="row">                                    
                                        <div class="col-4" id="codice_id">
                                            <h5 class="mb-1">Codice</h5>
                                            <input class="form-control" type="text" readonly maxlength="6" id="id" name="id" value="{{$ticket->id}}">
                                        </div>
                                        <div class="col-8 d-flex justify-content-end">
                                            <h5 class="mb-1">Attivo</h5>
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input ms-auto" type="checkbox" name="attivo" role="switch" {{($ticket->attivo == '1') ? 'checked' : ''}}  id="attivo">
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-8">
                                            <h5 class="mb-1">Descrizione</h5>
                                            <input class="form-control" type="text" maxlength="25" required name="descrizione" id="descrizione" value="{{$ticket->descrizione}}">
                                        </div>
                                        <div class="col-4">
                                            <h5 class="mb-1">Valore</h5>
                                            <input class="form-control" type="text"  name="valore" id="valore" value="{{number_format($ticket->valore, 2, ",", ".")}}">
                                        </div>                                        
                                    </div>                                                                                                             
                                </div>                                
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="saveticket">Salva</button>
                                    </div>
                                </div>
                            </form>
                            @endforeach
                        @else
                            <form action="{{@url('/ticketinsert')}}" enctype="multipart/form-data" id="ticketform" method="post">                            
                                <div class="card-body">
                                    {{csrf_field()}} 
                                    <div class="row">                                                                            
                                        <div class="col-8 d-flex justify-content-end">
                                            <h5 class="mb-1">Attivo</h5>
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input ms-auto" type="checkbox" name="attivo" checked role="switch" id="attivo">
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-8">
                                            <h5 class="mb-1">Descrizione</h5>
                                            <input class="form-control" type="text" maxlength="25" required name="descrizione" id="descrizione" value="">
                                        </div>
                                        <div class="col-4">
                                            <h5 class="mb-1">Valore</h5>
                                            <input class="form-control" type="text" name="valore" id="valore" value="">
                                        </div>
                                    </div>                                                                         
                                </div>                                                            
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="saveticket">Inserisci</button>
                                    </div>
                                </div>
                            </form>
                        @endif                        
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
                "infoFiltered": "(filtro su _MAX_ Pagamenti totali)",
                "emptyTable": "Nessun Pagamento trovato",
                "info": "Mostra da _START_ a _END_ su _TOTAL_ Pagamenti",
                "infoEmpty": "Mostra 0 di 0 su 0 Pagamenti",
            }
        });
    });
</script>