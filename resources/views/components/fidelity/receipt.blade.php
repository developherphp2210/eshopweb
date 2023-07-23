<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Scontrino n° {{$receipt['header']->transaction_number}} del {{$receipt['header']->data}}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">                
        <hr class="mt-0 mb-4" />
        <div class="card mb-4">
            <div class="card-body">
                <div class="row "> 
                    <div class="col-xl-4"></div>                   
                    <div class="col-xl-4">
                        <div class="border border-info p-2">
                            <h6 class="text-center">{{$receipt['setting']->riga1}}</h6>
                            <h6 class="text-center">{{$receipt['setting']->riga2}}</h6>
                            <h6 class="text-center">{{$receipt['setting']->riga3}}</h6>
                            <h6 class="text-center">{{$receipt['setting']->riga4}}</h6>
                            <h6 class="text-center">{{$receipt['setting']->riga5}}</h6>
                            <h6 class="text-center">{{$receipt['setting']->riga6}}</h6>
                            <br>
                            @foreach ($receipt['body'] as $body)
                                @if ($body->type == 'R')
                                <h6>*****RESO****</h6>
                                @endif
                                @if ($body->quantity > 1)
                                    <h6>{{$body->quantity}} x {{number_format($body->price, 2, ",", ".")}}</h6>
                                @endif
                                <div class="d-flex justify-content-between">
                                    <h6>{{$body->articolo}}</h6><h6>{{number_format($body->totale, 2, ",", ".")}}</h6>
                                </div>                                                                                                
                            @endforeach
                            @if ($receipt['header']->discount > 0)
                                <div class="d-flex justify-content-between">
                                    <h5>Sconto Subtotale</h5><h5>{{number_format($receipt['header']->discount, 2, ",", ".")}}</h5>
                                </div>
                            @endif
                            @foreach ($receipt['discount'] as $discount)
                                <div class="d-flex justify-content-between">
                                    <h5>{{$discount->description}}</h5><h5>- {{number_format($discount->discount, 2, ",", ".")}}</h5>
                                </div>
                            @endforeach
                            <br>
                            <div class="d-flex justify-content-between">
                                <h2>Totale</h2><h2>{{number_format($receipt['header']->amount, 2, ",", ".")}}</h2>
                            </div>
                            @foreach ($receipt['payment'] as $payment)
                                <div class="d-flex justify-content-between">
                                    <h6>{{$payment->description}}</h6><h6>{{number_format($payment->amount, 2, ",", ".")}}</h6>
                                </div>
                            @endforeach
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</main>