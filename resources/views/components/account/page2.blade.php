<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Opzioni Account - Security
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
            <a class="nav-link active " href="{{url('account/profile/2')}}">Security</a>
            @if ($user->type==='1')
            <a class="nav-link" href="{{url('account/profile/3')}}">Fidelity Card</a>
            @endif
            <a class="nav-link" href="">Notifications</a>
        </nav>
        <hr class="mt-0 mb-4" />
        <div class="row">
            <div class="col-lg-8">
                <!-- Change password card-->
                <div class="card mb-4">
                    <div class="card-header">Cambio Password</div>
                    @if ($notification != '')
                        @if ($notification['status'])
                            <div class="alert alert-success" id="alert" role="alert">
                        @else
                            <div class="alert alert-danger" id="alert" role="alert">   
                        @endif        
                            {{$notification['message']}}
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{url('saveaccount/2')}}" method="post">
                        {{csrf_field()}}
                            <!-- Form Group (current password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="currentPassword">Password Corrente</label>
                                <input class="form-control" id="currentPassword" type="password" name="oldpassword" placeholder="Scrivi la Password Corrente" />
                            </div>
                            <!-- Form Group (new password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPassword">Nuova Password</label>
                                <input class="form-control" id="inputPassword" type="password" name="newpassword" placeholder="Scrivi la nuova Password" />
                                <div id="passwordHelpBlock" class="form-text">
                                    La tua password deve essere lunga 8-20 caratteri, deve contenere lettere e numeri e almeno uno dei seguenti caratteri speciai ? ! @ # $ + - / .
                                </div>
                                <ul id="checkpassword">
                                    <li id="first" class="text-success mt-2 d-none"><i data-feather="check"></i> Lunghezza minima</li>
                                    <li id="second" class="text-success mt-2 d-none"><i data-feather="check"></i> Lettere</li>
                                    <li id="third" class="text-success mt-2 d-none"><i data-feather="check"></i> Numeri</li>
                                    <li id="fourth" class="text-success mt-2 d-none"><i data-feather="check"></i> Carattere Speciale</li>
                                </ul>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" id="VisiblePassword" type="checkbox" value="" />
                                    <label class="form-check-label" for="VisiblePassword">Mostra Password</label>
                                </div>
                            </div>
                            <!-- Form Group (confirm password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="confirmPassword">Conferma Password</label>
                                <input class="form-control" id="confirmPassword" type="password" placeholder="Conferma la nuova Password" />
                            </div>
                            <button class="btn btn-primary" id="btnregistry" disabled type="submit">Modifica</button>
                        </form>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</main>