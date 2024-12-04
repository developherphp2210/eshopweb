<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Anagrafiche - Metodi di Pagamento
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
                    <button type="button" id="addpagamento" class="btn btn-primary">Aggiungi Pagamento</button>
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
                            @foreach ($listapagamenti as $pagamento)
                            <tr onclick="schedaPag({{$pagamento->id}})">                                
                                <td>{{$pagamento->id}}</td>
                                <td>{{$pagamento->descrizione}}</td>
                                <td>
                                    @if ($pagamento->id > 1)
                                    <a title="Elimina" onclick="return confirm(`Sei sicuro di voler cancellare il Pagamento {{$pagamento->descrizione}} ? `)" href="{{url('/pagamentodelete/'.$pagamento->id)}}">
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
                        @if($listapagamenti->count() > 0)
                            <form action="{{@url('/pagamentoupdate/'.$listapagamenti[0]->id)}}" enctype="multipart/form-data" id="pagamentoform" method="post">
                                <div class="card-body">                                
                                    {{csrf_field()}}
                                    <div class="row">                                    
                                        <div class="col-4" id="codice_id">
                                            <h5 class="mb-1">Codice</h5>
                                            <input class="form-control" type="text" readonly maxlength="6" id="id" name="id" value="{{$listapagamenti[0]->id}}">
                                        </div>
                                        <div class="col-8 d-flex justify-content-end">
                                            <h5 class="mb-1">Attivo</h5>
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input ms-auto" type="checkbox" name="attivo" role="switch" {{($listapagamenti[0]->attivo == '1') ? 'checked' : ''}}  id="attivo">
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-8">
                                            <h5 class="mb-1">Descrizione</h5>
                                            <input class="form-control" type="text" maxlength="25" required name="descrizione" id="descrizione" value="{{$listapagamenti[0]->descrizione}}">
                                        </div>                                        
                                    </div>                                                                         
                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <h5 class="mb-1">Tipologia di Pagamento</h5>                                            
                                            <select class="form-select" required name="tipologia" id="tipologia">
                                                <option {{$listapagamenti[0]->tipologia == '1' ? 'selected' : ''}} value="1">Contante</option>                                            
                                                <option {{$listapagamenti[0]->tipologia == '2' ? 'selected' : ''}} value="2">Carta di Credito / Bancomat</option>                                            
                                                <option {{$listapagamenti[0]->tipologia == '3' ? 'selected' : ''}} value="3">Buoni Pasto</option>                                            
                                                <option {{$listapagamenti[0]->tipologia == '4' ? 'selected' : ''}} value="4">Carta Cliente</option>                                            
                                                <option {{$listapagamenti[0]->tipologia == '5' ? 'selected' : ''}} value="5">Assegno</option>                                            
                                                <option {{$listapagamenti[0]->tipologia == '6' ? 'selected' : ''}} value="6">A credito</option>                                            
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-1">Codice RT</h5>                                            
                                            <select class="form-select" required name="tipo_rt" id="tipo_rt">
                                                <option {{$listapagamenti[0]->tipo_rt == '0' ? 'selected' : ''}} value="0">Nessuno</option>                                            
                                                <option {{$listapagamenti[0]->tipo_rt == '9' ? 'selected' : ''}} value="9">Contanti</option>
                                                <option {{$listapagamenti[0]->tipo_rt == '10' ? 'selected' : ''}} value="10">Elettronico</option>                                            
                                                <option {{$listapagamenti[0]->tipo_rt == '11' ? 'selected' : ''}} value="11">Assegno</option>
                                                <option {{$listapagamenti[0]->tipo_rt == '6' ? 'selected' : ''}} value="6">Ticket</option>                                            
                                                <option {{$listapagamenti[0]->tipo_rt == '4' ? 'selected' : ''}} value="4">Sconto a Pagare</option>                                            
                                                <option {{$listapagamenti[0]->tipo_rt == '8' ? 'selected' : ''}} value="8">Buoni Monouso</option>                                            
                                                <option {{$listapagamenti[0]->tipo_rt == '1' ? 'selected' : ''}} value="1">Non Riscosso Beni</option>                                            
                                                <option {{$listapagamenti[0]->tipo_rt == '2' ? 'selected' : ''}} value="2">Non Riscosso Segue Fattura</option>                                            
                                                <option {{$listapagamenti[0]->tipo_rt == '3' ? 'selected' : ''}} value="3">Non Riscosso Servizi</option>                                                                                                                                                                                            
                                                <option {{$listapagamenti[0]->tipo_rt == '7' ? 'selected' : ''}} value="7">DCR SSN</option>                                            
                                                
                                                
                                                
                                                
                                            </select>
                                        </div>                                        
                                    </div>   
                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <h5 class="mb-1">Codice SDI</h5>
                                            <select class="form-select" required name="codice_sdi" id="codice_sdi">
                                                <option {{$listapagamenti[0]->codice_sdi == '0' ? 'selected' : ''}} value="0">Nessuno</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '1' ? 'selected' : ''}} value="1">Contanti (MP01)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '2' ? 'selected' : ''}} value="2">Assegno (MP02)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '3' ? 'selected' : ''}} value="3">Assegno circolare (MP03)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '4' ? 'selected' : ''}} value="4">Contanti presso Tesoreria (MP04)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '5' ? 'selected' : ''}} value="5">Bonifico (MP05)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '6' ? 'selected' : ''}} value="6">Vaglia cambiario (MP06)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '7' ? 'selected' : ''}} value="7">Bollettino bancario (MP07)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '8' ? 'selected' : ''}} value="8">Carta di credito (MP08)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '9' ? 'selected' : ''}} value="9">RID (MP09)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '10' ? 'selected' : ''}} value="10">RID utenze (MP10)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '11' ? 'selected' : ''}} value="11">RID veloce (MP11)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '12' ? 'selected' : ''}} value="12">Riba (MP12)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '13' ? 'selected' : ''}} value="13">MAV (MP13)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '14' ? 'selected' : ''}} value="14">Quietanza erario stato (MP14)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '15' ? 'selected' : ''}} value="15">Giroconto su conti di contabilità speciale (MP15)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '16' ? 'selected' : ''}} value="16">Domiciliazione bancaria (MP16)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '17' ? 'selected' : ''}} value="17">Domiciliazione postale (MP17)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '18' ? 'selected' : ''}} value="18">Bollettino di c/c postale (MP 18)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '19' ? 'selected' : ''}} value="19">Sepa direct debit (MP 19)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '20' ? 'selected' : ''}} value="20">Sepa direct debit core (MP 20)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '21' ? 'selected' : ''}} value="21">Sepa direct debit B2B (MP 21)</option>
                                                <option {{$listapagamenti[0]->codice_sdi == '22' ? 'selected' : ''}} value="22">Trattenute su somme già riscosse (MP 22)</option>
                                            </select>
                                        </div>
                                    </div> 
                                </div>                                
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="savepagamento">Salva</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form action="{{@url('/pagamentoinsert')}}" enctype="multipart/form-data" id="pagamentoform" method="post">                            
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
                                </div>                                                            
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary" id="savepagamento">Inserisci</button>
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