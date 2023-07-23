<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Anagrafica Cliente - {{$customer->ragsoc}}
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
            <a class="nav-link active ms-0" href="{{url('/customer/'.$customer->id.'/1')}}">Anagrafica Cliente</a>
            <a class="nav-link" href="{{url('/customer/'.$customer->id.'/2')}}">Partitario</a>
        </nav>
        <hr class="mt-0 mb-4" />
        <div class="row">
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <!-- <div class="card-header">Dati Profilo</div> -->
                    <div class="card-body">
                        <!-- Form Group (username)-->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="small mb-1" for="tessera">Tessera Fidelity</label>
                                <input class="form-control" readonly id="tessera" type="text" value="{{$customer->codice_fidelity}}" />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-10">
                                <label class="small mb-1" for="nome">Nome Tessera</label>
                                <input class="form-control" id="nome" type="text" readonly value="{{$customer->ragsoc}}" />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-8">
                                <label class="small mb-1" for="indirizzo">Indirizzo</label>
                                <input class="form-control" id="indirizzo" type="text" value="{{$customer->indirizzo}}" readonly />
                            </div>
                            <div class="col-md-2">
                                <label class="small mb-1" for="cap">CAP</label>
                                <input class="form-control" id="cap" type="text" value="{{$customer->cap}}" readonly />
                            </div>
                            <div class="col-md-2">
                                <label class="small mb-1" for="prov">Prov</label>
                                <input class="form-control" id="prov" type="text" value="{{$customer->prov}}" readonly />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-5">
                                <label class="small mb-1" for="citta">Citta</label>
                                <input class="form-control" id="citta" type="text" value="{{$customer->citta}}" readonly />
                            </div>
                            <div class="col-md-5">
                                <label class="small mb-1" for="codfisc">Codice Fiscale</label>
                                <input class="form-control" id="codfisc" type="text" value="{{$customer->codfisc}}" readonly />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-4">
                                <label class="small mb-1" for="tel">Telefono</label>
                                <input class="form-control" id="tel" type="text" value="{{$customer->tel}}" readonly />
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="cel">Cellulare</label>
                                <input class="form-control" id="cel" type="text" value="{{$customer->cel}}" readonly />
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="mail">E-Mail</label>
                                <input class="form-control" id="mail" type="text" value="{{$customer->email}}" readonly />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-4">
                                <label class="small mb-1" for="punti">Totale Punti</label>
                                <input class="form-control" id="punti" type="text" value="{{$customer->punti}}" readonly />
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="vendita">Totale Vendita</label>
                                <input class="form-control" id="vendita" type="text" value="{{number_format($customer->totale_vendita, 2, ',' , '.')}}" readonly />
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="data">Ultima Vendita</label>
                                <input class="form-control" id="data" type="text" value="{{$customer->data_ultimo_scontrino}}" readonly />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>