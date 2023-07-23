<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Inserisci Nuovo Utente
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <form action="{{url('/doregister_user')}}" method="POST">
            <div class="row">
                <div class="col-xl-12">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Dati Profilo</div>
                        <div class="card-body">
                            @if($errors->any())
                            @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{$error}}
                            </div>
                            @endforeach
                            @endif
                            {{csrf_field()}}
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Nominativo Azienza (come apparirà il nome agli altri utenti del sito)</label>
                                <input class="form-control" id="inputUsername" type="text" placeholder="Inserisci il Nominativo Azienda" name="user_name" />
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFirstName">Nome</label>
                                    <input class="form-control" id="inputFirstName" type="text" placeholder="Inserisci il tuo Nome" name="firstname" />
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Cognome</label>
                                    <input class="form-control" id="inputLastName" type="text" placeholder="Inserisci il tuo Cognome" name="lastname" />
                                </div>
                            </div>
                            <!-- Form Row        -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->
                                <div class="col-md-12">
                                    <label class="small mb-1" for="inputOrgName">Ragione Sociale</label>
                                    <input class="form-control" id="inputOrgName" type="text" placeholder="Inserisci il nome della tua Attività" name="business_name" />
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->
                                <div class="col-md-12">
                                    <label class="small mb-1" for="inputAddress">indirizzo</label>
                                    <input class="form-control" id="inputAddress" type="text" placeholder="Inserisci il tuo indirizzo" name="address" />
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (location)-->
                                <div class="col-md-10">
                                    <label class="small mb-1" for="inputLocation">Città</label>
                                    <input class="form-control" id="inputLocation" type="text" placeholder="Inserisci la tua Città" name="city" />
                                </div>
                                <div class="col-md-2">
                                    <label class="small mb-1" for="inputCap">CAP</label>
                                    <input class="form-control" id="inputCap" type="text" placeholder="CAP" name="cap" />
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPiva">P. IVA</label>
                                    <input class="form-control" id="inputPiva" type="text" placeholder="Inserisci la tua Partita IVA" name="piva" />
                                </div>
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputCodfisc">Codice Fiscale</label>
                                    <input class="form-control" id="inputCodfisc" type="text" placeholder="Inserisci il tuo Codice Fiscale" name="codfisc" />
                                </div>
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                <input class="form-control" require id="inputEmailAddress" type="email" placeholder="Inserisci la tua E-Mail" name="email" />
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Telefono</label>
                                    <input class="form-control" id="inputPhone" type="tel" placeholder="Inserisci il tuo numero di Telefono" name="phone" />
                                </div>
                                <!-- Form Group (birthday)-->
                                <!-- <div class="col-md-6">
                                        <label class="small mb-1" for="inputBirthday">Birthday</label>
                                        <input class="form-control" id="inputBirthday" type="text" name="birthday" placeholder="Enter your birthday" value="06/10/1988" />
                                    </div> -->
                            </div>
                            <!-- Save changes button-->
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>