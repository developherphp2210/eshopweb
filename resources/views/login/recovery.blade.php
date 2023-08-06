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
                                <div class="card-header justify-content-center">
                                    <h3 class="fw-light my-4">Recupera la tua Password</h3>
                                </div>
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
                                        <!-- Login form-->
                                        <form action="{{url('dopassword_recovery')}}" method="POST">
                                            {{csrf_field()}}
                                            <div class="mb-3">
                                                <label>Inserisci la tua Email e ti verra' inviata una Password Temporanea.</label>
                                            </div>
                                            <!-- Form Group (email address)-->
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control" id="inputEmailAddress" name="email" type="email" placeholder="Inserisci la tua Email" />
                                            </div>
                                            <!-- Form Group (password)-->

                                            <!-- Form Group (login box)-->
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <div>
                                                    <a href="{{url('/')}}">Ritorna al login</a>
                                                </div>
                                                <div>
                                                    <button class="btn btn-primary" id="btnregistry" type="submit">Reset Password</button>
                                                </div>
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