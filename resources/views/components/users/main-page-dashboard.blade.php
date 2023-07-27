<main>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-5">
        <!-- Custom page header alternative example-->
        <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
            <div class="me-4 mb-3 mb-sm-0">
                @if ($total['name'] != '')
                <h1 class="mb-0">Dashboard - {{$total['name']->description}}</h1>
                @else
                <h1 class="mb-0">Dashboard</h1>
                @endif
                <div class="small">
                    <span class="fw-500 text-primary" id="day">{{$total['name']}}</span>
                    <span id="datafull"></span>
                </div>
                @if ($total['shopid'] != '')
                <input type="hidden" id="shopid" value="{{$total['shopid']}}">
                @elseif ($total['tillid'] != '')
                <input type="hidden" id="tillid" value="{{$total['tillid']}}">
                @endif
            </div>
            <input type="hidden" id="sessionId" value="{{$total['sessionid']}}">
            <!-- Date range picker example-->
            <form id="formdate" action="{{url('/dashboard')}}" method="GET">
                <div class="input-group input-group-joined border-0 shadow" style="width: 16.5rem">
                    <input class="form-control " name="newdate" type="date" id="DateSelect" value="{{$total['date']}}" />
                    @if ($total['name'] != '')
                    <button class="btn" type="submit"><i data-feather="rotate-ccw"></i></button>
                    @endif
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <!-- Dashboard info widget 1-->
                <div class="card border-start-lg border-start-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-primary mb-1">Incasso Giornaliero</div>
                                <div class="h5">€ <i class="h5" id="totalday">{{number_format($total['day'][0], 2, ",", ".")}}</i></div>
                                <div class="text-xs fw-bold {{$total['day'][0] < $total['day'][1] ? 'text-danger' :'text-success' }} d-inline-flex align-items-center">
                                    <i class="me-1" data-feather="{{$total['day'][0] < $total['day'][1] ? 'trending-down' : 'trending-up'}}"></i>
                                    {{$total['day'][2] }} % - € {{number_format($total['day'][1], 2, ",", ".")}}
                                </div>
                            </div>
                            <!-- <div class="ms-2"><i class="feather-64" data-feather="dollar-sign"></i></div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <!-- Dashboard info widget 2-->
                <div class="card border-start-lg border-start-secondary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-secondary mb-1">Incasso Settimanale</div>
                                <div class="h5">€ {{number_format($total['week'][0], 2, ",", ".")}}</div>
                                <div class="text-xs fw-bold {{$total['week'][0] < $total['week'][1] ? 'text-danger' :'text-success' }} d-inline-flex align-items-center">
                                    <i class="me-1" data-feather="{{$total['week'][0] < $total['week'][1] ? 'trending-down' : 'trending-up'}}"></i>
                                    {{$total['week'][2] }} % - € {{number_format($total['week'][1], 2, ",", ".")}}
                                </div>
                            </div>
                            <!-- <div class="ms-2"><i class="feather-64" data-feather="dollar-sign"></i></div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <!-- Dashboard info widget 3-->
                <div class="card border-start-lg border-start-success h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-success mb-1">Incasso Mensile</div>
                                <div class="h5">€ {{number_format($total['month'][0], 2, ",", ".")}}</div>
                                <div class="text-xs fw-bold {{$total['month'][0] < $total['month'][1] ? 'text-danger' :'text-success' }} d-inline-flex align-items-center">
                                    <i class="me-1" data-feather="{{$total['month'][0] < $total['month'][1] ? 'trending-down' : 'trending-up'}}"></i>
                                    {{$total['month'][2] }} % - € {{number_format($total['month'][1], 2, ",", ".")}}
                                </div>
                                <!-- <div class="ms-2"><i class="feather-32" data-feather="dollar-sign"></i></div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card mb-4">
                        <div class="card-header">Attività Casse</div>
                        <div class="list-group list-group-flush small">
                            @php
                            $firstrow = true;
                            $deposito = '';
                            @endphp
                            @php($totale = 0)

                            @foreach ($total['tills'] as $till)
                            @if ($firstrow == true)
                            @php($deposito = $till->deposito)
                            @php($firstrow=false)
                            @elseif ($deposito !== $till->deposito)
                            <a class="list-group-item list-group-item-action text-green" href="{{url('/dashboardshop/'.$total['date'].'/'.$shopid)}}">
                                <!-- <i class="fas fa-dollar-sign fa-fw text-blue me-2"></i> -->
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>{{$deposito}}</div>
                                    <div>{{'€ '.number_format($totale, 2, ",", ".")}}</div>
                                </div>
                            </a>
                            @php($totale = 0)
                            @php($deposito = $till->deposito)
                            @endif
                            <a class="list-group-item list-group-item-action text-pink" href="{{url('/dashboardtill/'.$total['date'].'/'.$till->till_id)}}">
                                <!-- <i class="fas fa-dollar-sign fa-fw text-blue me-2"></i> -->
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>{{$till->cassa}}</div>
                                    <div>{{'€ '.number_format($till->prezzo, 2, ",", ".")}}</div>
                                </div>
                            </a>
                            @php($totale = $totale + $till->prezzo)
                            @php($shopid = $till->shop_id)
                            @endforeach
                            @if ($deposito !== '')
                            <a class="list-group-item list-group-item-action text-green" href="{{url('/dashboardshop/'.$total['date'].'/'.$shopid)}}">
                                <!-- <i class="fas fa-dollar-sign fa-fw text-blue me-2"></i> -->
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>{{$deposito}}</div>
                                    <div>{{'€ '.number_format($totale, 2, ",", ".")}}</div>
                                </div>
                            </a>
                            @endif
                        </div>
                        <div class="card-footer position-relative border-top-0">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mb-4">
                    <!-- Area chart example-->
                    <div class="card mb-4">
                        <div class="card-header">Ultimi 10 Giorni</div>
                        <div class="card-body">
                            <div class="mb-4"><canvas id="UltimeVendite" width="100%" height="30"></canvas></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Bar chart example-->
                            <div class="card h-100">
                                <div class="card-header">Top 10 Reparti</div>
                                <div class="card-body d-flex flex-column justify-content-center">
                                    <div class="mb-4"><canvas id="reparti" width="180" height="100%"></canvas></div>
                                </div>
                                <div class="card-footer position-relative">
                                    <a class="stretched-link" href="#!">
                                        <div class="text-xs d-flex align-items-center justify-content-between">
                                            View More Reports
                                            <i class="fas fa-long-arrow-alt-right"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Pie chart example-->
                            <div class="card h-100">
                                <div class="card-header">Forme di Pagamento</div>
                                <div class="card-body">
                                    <div class="mb-4"><canvas id="payment" width="100%" height="70"></canvas></div>
                                    <div class="list-group list-group-flush" id="mainlist">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    window.onload = setInterval(Orologio, 6000);

    function addZero(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }

    function Orologio() {

        var mesi = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];
        var giorno = ['Domenica', 'Lunedi', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato'];

        var d = new Date();
        var ora = addZero(d.getHours());
        var min = addZero(d.getMinutes());
        var gio = addZero(d.getDate());
        var mes = d.getMonth();
        var anno = addZero(d.getFullYear());
        document.getElementById('datafull').innerHTML = ' &middot ' + gio + ' ' + mesi[mes] + ' ' + anno + ' &middot ' + ora + ":" + min;
        document.getElementById('day').innerHTML = giorno[d.getDay()];
    }

    Orologio();
</script>