<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Scheda Articolo - {{$articles->description}}
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
            <a class="nav-link active ms-0" href="{{url('/article/'.$articles->id.'/1')}}">Scheda Articolo</a>
            <a class="nav-link" href="{{url('/article/'.$articles->id.'/2')}}">Partitario</a>
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
                                <label class="small mb-1" for="codart">Codice Articolo</label>
                                <input class="form-control" readonly id="codart" type="text" value="{{$articles->codart}}" />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-8">
                                <label class="small mb-1" for="desart">Descrizione</label>
                                <input class="form-control" id="desart" type="text" readonly value="{{$articles->description}}" />
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="prezzo">Ultimo prezzo di Vendita</label>
                                <input class="form-control" id="prezzo" type="text" value="{{$articles->price}}" readonly />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-8">
                                <label class="small mb-1" for="reparto">Reparto</label>
                                <input class="form-control" id="reparto" type="text" value="{{$articles->codrep.' - '.$articles->desrep}}" readonly />
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="iva">Aliquota Iva</label>
                                <input class="form-control" id="iva" type="text" value="{{$articles->codiva.' - '.$articles->desiva}}" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-4">
                                <label for="codean">Codici EAN</label>
                                @foreach ($codeans as $codean)
                                <input class="form-control form-control-sm" id="codean" type="text" value="{{$codean->code}}" readonly />
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>