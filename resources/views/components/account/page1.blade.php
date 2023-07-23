<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Opzioni Account - Profilo
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
            <a class="nav-link active ms-0" href="{{url('account/profile/1')}}">Il tuo Profilo</a>
            <a class="nav-link" href="{{url('account/profile/2')}}">Security</a>
            @if ($user->type==='1')
            <a class="nav-link" href="{{url('account/profile/3')}}">Fidelity Card</a>
            @endif
            <a class="nav-link" href="">Notifications</a>
        </nav>
        <hr class="mt-0 mb-4" />
        <form action="{{url('saveaccount/1')}}" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Immagine Profilo</div>
                        <div class="card-body text-center">

                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2" name="photo" id="imgaccount" src="{{asset('storage/'.$user->image)}}" alt="" />
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <!-- Profile picture upload button-->
                            <input class="form-control" type="file" name="photo" accept="image/*" id="uploadFile">
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Dati Profilo</div>
                        @if ($notification != '')
                            @if ($notification['status'])
                                <div class="alert alert-success" role="alert">
                            @else
                                <div class="alert alert-danger" role="alert">   
                            @endif        
                                {{$notification['message']}}
                            </div>
                        @endif
                        <div class="card-body">
                            {{csrf_field()}}
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Nominativo Azienza (come apparirà il tuo nome agli altri utenti del sito)</label>
                                <input class="form-control" id="inputUsername" type="text" placeholder="Inserisci il tuo Nominativo Aziendale" value="{{$user->user_name}}" name="user_name" />
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFirstName">Nome</label>
                                    <input class="form-control" id="inputFirstName" type="text" placeholder="Inserisci il tuo Nome" value="{{$user->firstname}}" name="firstname" />
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Cognome</label>
                                    <input class="form-control" id="inputLastName" type="text" placeholder="Inserisci il tuo Cognome" value="{{$user->lastname}}" name="lastname" />
                                </div>
                            </div>
                            @if ($user->type !== '1')
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->
                                <div class="col-md-12">
                                    <label class="small mb-1" for="inputOrgName">Ragione Sociale</label>
                                    <input class="form-control" id="inputOrgName" type="text" placeholder="Inserisci il nome della tua Attività" value="{{$user->business_name}}" name="business_name" />
                                </div>
                            </div>
                            @endif
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->
                                <div class="col-md-12">
                                    <label class="small mb-1" for="inputAddress">indirizzo</label>
                                    <input class="form-control" id="inputAddress" type="text" placeholder="Inserisci il tuo indirizzo" value="{{$user->address}}" name="address" />
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (location)-->
                                <div class="col-md-10">
                                    <label class="small mb-1" for="inputLocation">Città</label>
                                    <input class="form-control" id="inputLocation" type="text" placeholder="Inserisci la tua Città" value="{{$user->city}}" name="city" />
                                </div>
                                <div class="col-md-2">
                                    <label class="small mb-1" for="inputCap">CAP</label>
                                    <input class="form-control" id="inputCap" type="text" placeholder="CAP" value="{{$user->cap}}" name="cap" />
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                @if ($user->type !== '1')
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPiva">P. IVA</label>
                                    <input class="form-control" id="inputPiva" type="text" placeholder="Inserisci la tua Partita IVA" value="{{$user->piva}}" name="piva" />
                                </div>
                                @endif
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputCodfisc">Codice Fiscale</label>
                                    <input class="form-control" id="inputCodfisc" type="text" placeholder="Inserisci il tuo Codice Fiscale" value="{{$user->codfisc}}" name="codfisc" />
                                </div>
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                <input class="form-control" readonly id="inputEmailAddress" type="email" placeholder="Inserisci la tua E-Mail" value="{{$user->email}}" name="email" />
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Telefono</label>
                                    <input class="form-control" id="inputPhone" type="tel" placeholder="Inserisci il tuo numero di Telefono" value="{{$user->phone}}" name="phone" />
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