<x-header :title="$title"></x-header>
<body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container-xl px-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <!-- Basic login form-->
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header justify-content-center"><h3 class="fw-light my-4">Registrazione Cliente</h3></div>
                                    @if($errors->any())
                                        @foreach($errors->all() as $error)
                                            <div class="alert alert-danger" role="alert">
                                                {{$error}}
                                            </div>
                                        @endforeach
                                    @endif 
                                    <div class="card-body">
                                        <!-- Login form-->
                                        <form action="{{url('doregister_fidelity')}}" method="POST">
                                            {{csrf_field()}}
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputName">Nome</label>
                                                <input class="form-control" id="inputName" name="user_name" type="text" placeholder="Inserisci il tuo nome" />
                                            </div>
                                            <!-- Form Group (email address)-->
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control" id="inputEmailAddress" name="email" type="email" placeholder="Inserisci la tua Email" />
                                            </div>
                                            <!-- Form Group (password)-->
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control" id="inputPassword" type="password" maxlength="20" name="password" placeholder="Inserisci Password" />                                            
                                                <div id="passwordHelpBlock" class="form-text">
                                                    La tua password deve essere lunga 8-20 caratteri, deve contenere lettere e numeri e almeno uno dei seguenti caratteri speciali ? ! @ # $ + - / .
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
                                            <!-- Form Group (login box)-->
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">                                                
                                                <button class="btn btn-primary" id="btnregistry" disabled type="submit">Registrati</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- <div class="card-footer text-center">
                                        <div class="small"><a href="auth-register-basic.html">Need an account? Sign up!</a></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="footer-admin mt-auto footer-dark">
                    <div class="container-xl px-4">
                        <div class="row">
                            <div class="col-md-6 small">Copyright &copy; Your Website 2021</div>
                            <div class="col-md-6 text-md-end small">
                                <a href="#!">Privacy Policy</a>
                                &middot;
                                <a href="#!">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
<x-footer></x-footer> 
</body>
</html>       