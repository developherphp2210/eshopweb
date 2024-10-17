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
    <div class="px-4 mt-4">
     
    
        <div class="mb-4">
            
            <div> 
                <form action="{{@url('/ricercaArticoli')}}" method="get" id="myform">
                {{csrf_field()}}                           
                    <div class="row">
                        <div class="col-4">
                            <div class="input-group">
                                <div class="input-group-text" id="btnGroupAddon"><span class="fas fa-search search-box-icon"></span></div>
                                <input type="text" name="codice" value="{{isset($articoli['valori'][0]) ? $articoli['valori'][0] : '' }}" class="form-control" placeholder="Ricerca Articolo" id="mysearch" aria-label="Ricerca Articolo" aria-describedby="btnGroupAddon">
                            </div>
                        </div> 
                        <div class="col-8">
                            <div class="btn-group position-static text-nowrap">
                                <select class="form-select mb-3" aria-label="Reparti" name="reparti" id="departmentList">
                                    <option selected value="0">Reparti</option>
                                    @foreach ($articoli['reparti'] as $reparti)
                                    <option {{( (isset($articoli['valori'])) and ( $articoli['valori'][1] == $reparti->id)) ? 'selected' : ''}}  value="{{$reparti->id}}">{{$reparti->descrizione}}</option>                              
                                    @endforeach
                                </select>                            
                            </div>
                        </div>                   
                    </div> 
                </form>                                                           
            </div>
            
        </div>
        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-white border-top border-bottom border-200 position-relative top-1">
            <div class="table-responsive scrollbar mx-n1 px-1">
                <table class="table fs--1 mb-0">
                    <thead>
                        <tr>                                                        
                            <th class="sort white-space-nowrap fs-0 align-middle ps-4" scope="col" style="width:70px;" >Codice</th>
                            <th class="sort align-middle fs-0 text-center ps-4" scope="col" style="width:350px;">Descrizione</th>
                            <th class="sort align-middle fs-0 ps-4" scope="col" style="width:150px;">Reparto</th>
                            <th class="sort align-middle fs-0 ps-4" scope="col" style="width:150px;">Listino</th>
                            <th class="sort align-middle fs-0 ps-3" scope="col" style="width:100px;">Prezzo</th>
                            <th class="sort align-middle fs-0 text-center ps-4" scope="col" style="width:150px;">Codice EAN</th>
                            <th scope="col" style="width:50px;"></th>                            
                        </tr>
                    </thead>
                    <tbody class="list" id="products-table-body">                        
                            @foreach ($articoli['lista'] as $articolo)
                                <tr class="position-static" ondblclick="schedaArt({{$articolo->id}})" >
                                    <td class="vendor align-middle fw-semi-bold ps-4">{{$articolo->codice}}</td>
                                    <td class="vendor align-middle fw-semi-bold ps-4">{{$articolo->descrizione}}</td>
                                    <td class="category align-middle fw-semi-bold ps-4">{{$articolo->reparto}}</td>
                                    <td class="category align-middle fw-semi-bold ps-4">{{$articolo->nomelist}}</td>
                                    <td class="price align-middle text-end fw-semi-bold ps-4">{{'€ '.number_format($articolo->przlor, 5, ",", ".")}}</td>
                                    <td class="vendor align-middle fw-semi-bold ps-4">{{$articolo->barcode}}</td>
                                    <td class="align-middle white-space-nowrap text-end pe-0 ps-4 btn-reveal-trigger">
                                        <a class="btn btn-sm transition-none btn-reveal fs--2" href="/articolo/{{$articolo->id}}/1" title='Scheda Articolo'>
                                            <span data-feather="edit"></span>
                                        </a>                                       
                                    </div>
                                    </td>
                                </tr>                            
                            @endforeach                                                               
                    </tbody>
                </table>
            </div>
            <div class="row align-items-center justify-content-between py-2 pe-0 fs--1">
                <div class="col-auto d-flex">
                    <p class="mb-0 d-none d-sm-block me-3 fw-semi-bold text-900" > Totale articoli <span id="totart">{{(isset($articles['value'])) ? $articles['value'][4] : '0'}}</span> </p>                    
                </div>                
            </div>
        </div>    
</div>
    
</main>
<script>
    $(document).ready(function() {
        $('#lista').DataTable({
            "lengthMenu": [100, 150, 300, 500],
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