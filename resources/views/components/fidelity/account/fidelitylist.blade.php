<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Gestione Fidelity Card
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
            <a class="nav-link ms-0" href="{{url('account/profile/1')}}">Il tuo Profilo</a>
            <a class="nav-link" href="{{url('account/profile/2')}}">Security</a>
            <a class="nav-link active" href="{{url('account/profile/3')}}">Fidelity Card</a>
            <a class="nav-link" href="">Notifications</a>
        </nav>
        <hr class="mt-0 mb-4" />
        <div class="card mb-4">
            <div class="card-body">
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger" id="alert" role="alert">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
                <div class="table-responsive">
                    <table id="lista" class="table table-striped table-sm " style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">Codice Tessera</th>
                                <th class="text-center">Negozio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cards as $card)
                            <tr>
                                <td>{{$card->codice_fidelity}}</td>
                                <td>{{$card->user_name}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid justify-content-end">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#AddFidelity">Aggiungi Tessera Fidelity</button>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Modal component-->
<div class="modal fade" id="AddFidelity" tabindex="-1" aria-labelledby="AddFidelityLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="AddFidelityLabel">Aggiungi La tua Tessera Fidelity</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('/add_fidelity')}}" method="post">
                <div class="modal-body">
                    {{csrf_field()}}
                    <input class="form-control" type="text" autofocus name="fidelitycard">
                    <input type="hidden" name="id" value="{{$user->id}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                    <button type="Submit" class="btn btn-primary">Aggiungi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if (session('codice_fidelity') === '')
<script>
    alert('Collega subito la tua tessera fidelity');
</script>
@endif