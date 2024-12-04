<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Scheda Articolo - {{$listaArticolo['articolo']->descrizione}}
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
            <a class="nav-link active ms-0" href="{{url('/articolo/'.$listaArticolo['articolo']->id.'/1')}}">Scheda Articolo</a>
            <a class="nav-link" href="{{url('/articolo/'.$listaArticolo['articolo']->id.'/2')}}">Partitario</a>
        </nav>
        <hr class="mt-0 mb-4" />
        <div class="row">
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <!-- <div class="card-header">Dati Profilo</div> -->
                    <div class="card-body">
                        <!-- Form Group (username)-->
                        <div class="row">
                            <div class="col-8">
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="small mb-1" for="codart">Codice Articolo</label>
                                        <input class="form-control" readonly id="codart" type="text" value="{{$listaArticolo['articolo']->codart}}" />
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-12">
                                        <label class="small mb-1" for="desart">Descrizione</label>
                                        <input class="form-control" id="desart" type="text" readonly value="{{$listaArticolo['articolo']->descrizione}}" />
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-8">
                                        <label class="small mb-1" for="reparto">Reparto</label>
                                        <input class="form-control" id="reparto" type="text" value="{{$listaArticolo['articolo']->codrep.' - '.$listaArticolo['articolo']->desrep}}" readonly />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small mb-1" for="iva">Aliquota Iva</label>
                                        <input class="form-control" id="iva" type="text" value="{{$listaArticolo['articolo']->codiva.' - '.$listaArticolo['articolo']->desiva}}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div>
                                    <table class="table table-striped">
                                        <thead>
                                            <th scope="col">Listino</th>
                                            <th scope="col">Prezzo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($listaArticolo['prezzi'] as $prezzi)
                                            <tr>
                                                <td>{{$prezzi->codice.' - '.$prezzi->descrizione}}</td>
                                                <td class="text-end">€ {{number_format($prezzi->prezzo, 2, ",", ".")}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-4">
                                <table class="table table-striped">
                                    <thead>
                                        <th scope="col">Codice EAN</th>
                                        <th class="text-end" scope="col">Prezzo Speciale</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listaArticolo['ean'] as $codean)
                                        <tr>
                                            <td>{{$codean->barcode}}</td>
                                            <td class="text-end">€ {{number_format($codean->prezzo_special, 2, ",", ".")}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>