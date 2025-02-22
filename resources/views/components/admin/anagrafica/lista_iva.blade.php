<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container px-4">
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
    <div class="px-4 mt-4">
        <div class="row g-4 g-xl-6">
            <div class="col-xl-5 col-xxl-5">                
                <div class="table-responsive">
                    <table id="lista" class="table table-hover table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>Codice</th>
                                <th>Descrizione</th>
                                <th>Aliquota</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($aliquote as $iva)
                            <tr onclick="schedaIva({{$iva->id}})">
                                <td>{{$iva->codice}}</td>
                                <td>{{$iva->descrizione}}</td>
                                <td>{{$iva->aliquota}}</td>                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xl-7 col-xxl-7 p-4">
                <div class="sticky-leads-sidebar">
                    <div class="card mb-4">
                        @if($aliquote->count() > 0)
                            @php                            
                               $lastid = session('lastid');                                                         
                               $aliquota = $aliquote->filter( function( $value,int $key) use($lastid) {
                                    if ($value->id == $lastid){
                                        return $value;
                                    }
                                })->first();                                                                                                                                                                                                                                                                                
                            @endphp                      
                            <form action="{{@url('/ivaupdate/'.$aliquote[0]->id)}}" enctype="multipart/form-data" id="ivaform" method="post">
                                <div class="card-body">                                
                                    {{csrf_field()}}
                                    <div class="row">                                    
                                        <div class="col-4">
                                            <h5 class="mb-1">Codice</h5>
                                            <input class="form-control" readonly type="text" maxlength="6" id="codice" name="codice" value="{{$aliquota->codice}}">
                                        </div>
                                        <div class="col-8 d-flex justify-content-end">
                                            <h5 class="mb-1">Attivo</h5>
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input ms-auto" type="checkbox" name="attivo" role="switch" {{($aliquota->attivo == '1') ? 'checked' : ''}}  id="attivo">
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-8">
                                            <h5 class="mb-1">Descrizione</h5>
                                            <input class="form-control" type="text" maxlength="25" required name="descrizione" id="descrizione" value="{{$aliquota->descrizione}}">
                                        </div>
                                    </div>                                     
                                    <div class="row mt-4">
                                        <div class="col-4">
                                            <h5 class="mb-1">Aliquota in %</h5>
                                            <input class="form-control" type="number" min=0  required name="aliquota" id="aliquota" value="{{$aliquota->aliquota}}">
                                        </div>
                                        <div class="col-4">
                                            <h5 class="mb-1">Reparto Fiscale</h5>
                                            <input class="form-control" type="number" min="1" required name="reparto_fiscale" id="reparto_fiscale" value="{{$aliquota->reparto_fiscale}}">
                                        </div>
                                    </div>
                                </div>    
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="saveiva">Salva</button>
                                    </div>
                                </div>
                            </form>
                            @php
                                session()->forget('lastid');
                            @endphp
                        @else
                            <form action="{{@url('/ivainsert')}}" enctype="multipart/form-data" id="ivaform" method="post">                            
                                <div class="card-body">
                                    {{csrf_field()}}    
                                    <div class="row">                                    
                                        <div class="col-4">
                                            <h5 class="mb-1">Codice</h5>
                                            <input class="form-control" type="text" maxlength="6" id="codice" name="codice" value="">
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
                                            <input class="form-control" type="text" maxlength="25" required name="descrizione" id="descrizione" value="">
                                        </div>
                                    </div>                                     
                                    <div class="row mt-4">
                                        <div class="col-4">
                                            <h5 class="mb-1">Aliquota in %</h5>
                                            <input class="form-control" type="number" min=0  required name="aliquota" id="aliquota" value="">
                                        </div>
                                        <div class="col-4">
                                            <h5 class="mb-1">Reparto Fiscale</h5>
                                            <input class="form-control" type="number" min="1" required name="reparto_fiscale" id="reparto_fiscale" value="">
                                        </div>
                                    </div>
                                </div>                                                            
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary d-none" id="saveiva">Inserisci</button>
                                    </div>
                                </div>
                            </form>
                        @endif    
                    </div>
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