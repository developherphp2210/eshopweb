<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="credit-card"></i></div>
                            Linea Fidelity
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
                    <button type="button" id="addlineafid" class="btn btn-primary">Nuova Linea Fidelity</button>
                </div>                
                <div class="table-responsive">
                    <table id="lista" class="table table-hover table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>Codice</th>
                                <th>Descrizione</th>
                                <th></th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lineafidelity as $lineafid)
                            <tr onclick="schedaLinea({{$lineafid->id}})">
                                <td>{{$lineafid->codice}}</td>
                                <td>{{$lineafid->descrizione}}</td>
                                <td>
                                    <a title="Elimina" onclick="return confirm(`Sei sicuro di voler cancellare la Linea Fidelity {{$lineafid->descrizione}} ? `)" href="{{url('/lineafiddelete/'.$lineafid->id)}}">
                                            <button class="btn btn-datatable btn-icon btn-transparent-dark"><i style="color:red" data-feather="trash-2"></i></button>
                                    </a>
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
                        @if($lineafidelity->count() > 0)
                            <form action="{{@url('/lineafidupdate/'.$lineafidelity[0]->id)}}" enctype="multipart/form-data" id="lineafidform" method="post">
                                <div class="card-body">                                
                                    {{csrf_field()}}
                                    <div class="row">                                    
                                        <div class="col-4">
                                            <h5 class="mb-1">Codice</h5>
                                            <input class="form-control" type="text" maxlength="7" id="codice" name="codice" value="{{$lineafidelity[0]->codice}}">
                                        </div>
                                        <div class="col-8 d-flex justify-content-end">
                                            <h5 class="mb-1">Attivo</h5>
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input ms-auto" type="checkbox" name="attivo" role="switch" {{($lineafidelity[0]->attivo == '1') ? 'checked' : ''}}  id="attivo">
                                            </div>   
                                        </div>                                        
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-8">
                                            <h5 class="mb-1">Descrizione</h5>
                                            <input class="form-control" type="text" maxlength="30" required name="descrizione" id="descrizione" value="{{$lineafidelity[0]->descrizione}}">
                                        </div>
                                        <div class="col-4">
                                            <label for="generati">N° Tessere</label>
                                            <input type="number" readonly class="form-control" id="generati" name="generati" value="{{$lineafidelity[0]->generati}}">
                                        </div>
                                    </div>                                                                         
                                    <div class=" row mt-4">
                                        <div class="col-12 d-flex justify-content-center">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary-soft">Generazione Tessere Fidelity</button>
                                        </div>
                                    </div>
                                </div>    
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="savelineafid">Salva</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form action="{{@url('/lineafidinsert')}}" enctype="multipart/form-data" id="lineafidform" method="post">                            
                                <div class="card-body">
                                    {{csrf_field()}} 
                                    <div class="row">                                    
                                        <div class="col-4">
                                            <h5 class="mb-1">Codice</h5>
                                            <input class="form-control" type="text" maxlength="7" id="codice" name="codice" value="">
                                        </div>
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
                                            <input class="form-control" type="text" maxlength="30" required name="descrizione" id="descrizione" value="">
                                        </div>
                                        <div class="col-4">
                                            <label for="generati">N° Tessere</label>
                                            <input type="number" readonly class="form-control" id="generati" name="generati" value="">
                                        </div>
                                    </div>                                                                           
                                </div>                                                            
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="savelineafid">Inserisci</button>
                                    </div>
                                </div>
                            </form>
                        @endif                        
                </div>
            </div>    
        </div>    
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Generazione Tessere Fidelity</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @if($lineafidelity->count() > 0)
                <form action="/generazionefidelity/{{$lineafidelity[0]->id}}" method="post" id="generafidelity">
                {{csrf_field()}} 
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label for="codini">Dal numero....</label>
                                <input type="number" class="form-control" id="codini" required name="codini">
                            </div>
                            <div class="col-6">
                                <label for="codfin">Al numero....</label>
                                <input type="number" class="form-control" id="codfin" required name="codfin">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-8">
                                <label for="desini">Nome Tessera</label>
                                <input type="text" class="form-control" id="desini" required name="descrizione">
                            </div>
                            <div class="col-4">
                                <label for="livello">Livello</label>
                                <input type="number" class="form-control" min="1" id="livello" required name="livello">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="gencli" id="gencli">
                                    <label class="form-check-label" for="gencli">
                                        Generazione Clienti
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 d-none" id="mostralistino">
                            <div class="col-8">
                                <label for="listino">Listino di Vendita</label>
                                <select name="idlistino" id="listino" class="form-control">
                                    <option value="">Seleziona un Listino</option>
                                    @foreach($listino as $list)
                                    <option value="{{$list->id}}">{{$list->codice.' - '.$list->descrizione}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                        <button type="submit" class="btn btn-primary">Genera</button>
                    </div>
                </form>
                @endif
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
                "infoFiltered": "(filtro su _MAX_ Linee totali)",
                "emptyTable": "Nessuna Linea trovata",
                "info": "Mostra da _START_ a _END_ su _TOTAL_ Linee",
                "infoEmpty": "Mostra 0 di 0 su 0 Linee",
            }
        });
    });
</script>