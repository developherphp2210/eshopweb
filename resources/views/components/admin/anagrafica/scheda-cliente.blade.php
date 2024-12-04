<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Anagrafica Cliente - {{$cliente['anagrafica']->ragsoc}}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="{{url('/cliente/'.$cliente['anagrafica']->id.'/1')}}">Anagrafica Cliente</a>
            <a class="nav-link" href="{{url('/cliente/'.$cliente['anagrafica']->id.'/2')}}">Partitario</a>
            <a class="nav-link" href="{{url('/cliente/'.$cliente['anagrafica']->id.'/3')}}">Tessere Fidelity</a>
        </nav>
        <hr class="mt-0 mb-4" />
        <div class="row">
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <form action="/clientiupdate/{{$cliente['anagrafica']->id}}" method="post"> 
                    {{csrf_field()}}    
                        <div class="card-body">                                                
                            <div class="row gx-3 mb-3">
                                <div class="col-md-10">
                                    <label class="small mb-1" for="nome">Nome Cliente</label>
                                    <input class="form-control" id="nome" maxlength="40" name="ragsoc" type="text" {{($cliente['anagrafica']->ideshop != '0') ? 'readonly' : ''}} value="{{$cliente['anagrafica']->ragsoc}}" />
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-8">
                                    <label class="small mb-1" for="indirizzo">Indirizzo</label>
                                    <input class="form-control" maxlength="30" id="indirizzo" type="text" name="indirizzo" value="{{$cliente['anagrafica']->indirizzo}}" {{($cliente['anagrafica']->ideshop != '0') ? 'readonly' : ''}} />
                                </div>
                                <div class="col-md-2">
                                    <label class="small mb-1" for="cap">CAP</label>
                                    <input class="form-control" max="5" id="cap" type="text" name="cap" value="{{$cliente['anagrafica']->cap}}" {{($cliente['anagrafica']->ideshop != '0') ? 'readonly' : ''}} />
                                </div>
                                <div class="col-md-2">
                                    <label class="small mb-1" for="prov">Prov</label>
                                    <input class="form-control" maxlength="2" id="prov" type="text" name="prov" value="{{$cliente['anagrafica']->prov}}" {{($cliente['anagrafica']->ideshop != '0') ? 'readonly' : ''}} />
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-5">
                                    <label class="small mb-1" for="citta">Citta</label>
                                    <input class="form-control" maxlength="30" id="citta" type="text" name="citta" value="{{$cliente['anagrafica']->citta}}" {{($cliente['anagrafica']->ideshop != '0') ? 'readonly' : ''}} />
                                </div>
                                <div class="col-md-5">
                                    <label class="small mb-1" for="codfisc">Codice Fiscale</label>
                                    <input class="form-control" id="codfisc" maxlength="16" type="text" name="codfisc" value="{{$cliente['anagrafica']->codfisc}}" {{($cliente['anagrafica']->ideshop != '0') ? 'readonly' : ''}} />
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-4">
                                    <label class="small mb-1" for="tel">Telefono</label>
                                    <input class="form-control" id="tel" type="text" maxlength="15" name="tel" value="{{$cliente['anagrafica']->tel}}" {{($cliente['anagrafica']->ideshop != '0') ? 'readonly' : ''}} />
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="cel">Cellulare</label>
                                    <input class="form-control" id="cel" type="text" name="cel" maxlength="15" value="{{$cliente['anagrafica']->cel}}" {{($cliente['anagrafica']->ideshop != '0') ? 'readonly' : ''}} />
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="mail">E-Mail</label>
                                    <input class="form-control" id="mail" maxlength="40" type="text" name="email" value="{{$cliente['anagrafica']->email}}" {{($cliente['anagrafica']->ideshop != '0') ? 'readonly' : ''}} />
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-3">
                                    <label class="small mb-1" for="punti">Totale Punti</label>
                                    <input class="form-control" id="punti" type="text" value="{{$cliente['totpunti']}}" readonly />
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1" for="punti">Totale Prepagata</label>
                                    <input class="form-control" id="punti" type="text" value="{{$cliente['totprepagata']}}" readonly />
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1" for="vendita">Totale Vendita</label>
                                    <input class="form-control" id="vendita" type="text" value="{{number_format($cliente['anagrafica']->totale_vendita, 2, ',' , '.')}}" readonly />
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1" for="data">Ultima Vendita</label>
                                    <input class="form-control" id="data" type="text" value="{{$cliente['anagrafica']->data_ultimo_scontrino}}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-primary">Salva</button>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</main>