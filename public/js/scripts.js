/*!
    * Start Bootstrap - SB Admin Pro v2.0.1 (https://shop.startbootstrap.com/product/sb-admin-pro)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under SEE_LICENSE (https://github.com/StartBootstrap/sb-admin-pro/blob/master/LICENSE)
    */
    window.addEventListener('DOMContentLoaded', event => {
    // Activate feather
    feather.replace();

    // Enable tooltips globally
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Enable popovers globally
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Activate Bootstrap scrollspy for the sticky nav component
    const stickyNav = document.body.querySelector('#stickyNav');
    if (stickyNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#stickyNav',
            offset: 82,
            
        });
    }

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sidenav-toggled'));
        });
    }

    // Close side navigation when width < LG
    const sidenavContent = document.body.querySelector('#layoutSidenav_content');
    if (sidenavContent) {
        sidenavContent.addEventListener('click', event => {
            const BOOTSTRAP_LG_WIDTH = 992;
            if (window.innerWidth >= 992) {
                return;
            }
            if (document.body.classList.contains("sidenav-toggled")) {
                document.body.classList.toggle("sidenav-toggled");
            }
        });
    }

    // Add active state to sidbar nav links
    let activatedPath = window.location.pathname;

    if (activatedPath) {
        activatedPath = activatedPath[0];
    } else {
        activatedPath = 'index.html';
    }

    const targetAnchors = document.body.querySelectorAll('[href="' + activatedPath + '"].nav-link');

    targetAnchors.forEach(targetAnchor => {
        let parentNode = targetAnchor.parentNode;
        while (parentNode !== null && parentNode !== document.documentElement) {
            if (parentNode.classList.contains('collapse')) {
                parentNode.classList.add('show');
                const parentNavLink = document.body.querySelector(
                    '[data-bs-target="#' + parentNode.id + '"]'
                );
                parentNavLink.classList.remove('collapsed');
                parentNavLink.classList.add('active');
            }
            parentNode = parentNode.parentNode;
        }
        targetAnchor.classList.add('active');
    });
        
});

function openTab(event, nomeid) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(nomeid).style.display = "block";
    event.currentTarget.className += " active";
}

let upload = document.getElementById('uploadFile');
if (upload){
    upload.addEventListener('change',function(e){    
        var selectedFile = e.target.files[0];
        var reader = new FileReader();    
        var imgtag = document.getElementById('imgaccount');
        imgtag.title = selectedFile.name;
        reader.onload = function (e) {
            imgtag.src = e.target.result;
        };
        reader.readAsDataURL(selectedFile);    
});
}

let dataselect = document.getElementById('DateSelect');
if (dataselect){
    dataselect.addEventListener('change',function(){
        document.getElementById('formdate').submit();        
});
}

let ul = document.querySelector('#checkpassword');
let psw = document.querySelector('#inputPassword');
let btn = document.querySelector('#btnregistry');
let visiblepsw = document.querySelector('#VisiblePassword');

if (visiblepsw){
    visiblepsw.addEventListener('click', () => {        
        if (visiblepsw.checked){
            document.querySelector('#inputPassword').type = 'text';                
        } else {
            document.querySelector('#inputPassword').type = 'password';    
        }
    })

}

var check = [0,0,0,0];
if (ul){
    psw.addEventListener('keypress',(event) => {                 
        if (psw.value.length > 8 ){
            document.querySelector('#first').classList.remove('d-none');
            check[0] = 1;
        }else{
            document.querySelector('#first').classList.add('d-none');
            check[0] = 0;
        }                   
        if ( ((event.keyCode >= 97) && (event.keyCode <= 122)) || ( (event.keyCode >=65) && (event.keyCode <= 90) ) ){
            document.querySelector('#second').classList.remove('d-none');
            check[1] = 1;
        }      
        if ( (event.keyCode >= 48) && (event.keyCode <=57)){
            document.querySelector('#third').classList.remove('d-none');
            check[2] = 1;
        }        
        if ( (event.keyCode >= 33) && (event.keyCode <= 47) ){
            document.querySelector('#fourth').classList.remove('d-none');
            check[3] = 1;
        }
    if ( (check[0]===1) && (check[1]===1) && (check[2]===1) && (check[3]===1)) {
        btn.disabled = false;
    } else {
        btn.disabled = true;
    }  
    })

    psw.addEventListener('keydown', (event) => {
        if ( (event.keyCode == 8) || (event.keyCode == 18)){
            document.querySelector('#second').classList.add('d-none');
            check[1] = 0;
            document.querySelector('#third').classList.add('d-none');
            check[2] = 0;
            document.querySelector('#fourth').classList.add('d-none');
            check[3] = 0;
            for (let i=0;i<(psw.value.length-1);i++){
                if (psw.value.length > 8 ){
                    document.querySelector('#first').classList.remove('d-none');
                    check[0] = 1;
                }else{
                    document.querySelector('#first').classList.add('d-none');
                    check[0] = 0;
                }   
                if ( ((psw.value.charCodeAt(i) >= 97) && (psw.value.charCodeAt(i) <= 122)) || ( (psw.value.charCodeAt(i) >=65) && (psw.value.charCodeAt(i) <= 90) ) ){
                    document.querySelector('#second').classList.remove('d-none');
                    check[1] = 1;
                }      
                if ( (psw.value.charCodeAt(i) >= 48) && (psw.value.charCodeAt(i) <=57)){
                    document.querySelector('#third').classList.remove('d-none');
                    check[2] = 1;
                }        
                if ( (psw.value.charCodeAt(i) >= 33) && (psw.value.charCodeAt(i) <= 47) ){
                    document.querySelector('#fourth').classList.remove('d-none');
                    check[3] = 1;
                }                                
            }
            if ( (check[0]===1) && (check[1]===1) && (check[2]===1) && (check[3]===1)) {
                btn.disabled = false;
            } else {
                btn.disabled = true;
            } 
        }
    })
}

/**  GESTIONE ALIQUOTE IVA  */

const saveiva = document.querySelector('#saveiva');

if (saveiva){    
    const addiva = document.querySelector('#addiva');    
    const ivaform = document.querySelector('#ivaform');

    addiva.addEventListener('click',( ) => {                
        document.querySelector('#codice').value = '';         
        document.querySelector('#descrizione').value = '';
        document.querySelector('#aliquota').value = '';         
        document.querySelector('#reparto_fiscale').value = '';
        document.querySelector('#attivo').checked = true;
        ivaform.action = '/ivainsert';
        saveiva.innerHTML = 'Inserisci';
    });

    function schedaIva(id)
    {
        fetch('/api/iva/'+id)
        .then((response) => {
            return response.json();
        }).then((resp) => {            
            document.querySelector('#codice').value = resp['codice'];             
            document.querySelector('#descrizione').value = resp['descrizione']; 
            document.querySelector('#aliquota').value = resp['aliquota']; 
            document.querySelector('#reparto_fiscale').value = resp['reparto_fiscale'];                      
            (resp['attivo'] == '1') ? document.getElementById('attivo').checked = true : document.getElementById('attivo').checked =  false;
            ivaform.action = '/ivaupdate/'+id;
            saveiva.innerHTML = 'Modifica';
        });
    }
}

/**  GESTIONE REPARTI  */

const savereparto = document.querySelector('#savereparto');

if (savereparto){    
    const addreparto = document.querySelector('#addreparto');    
    const repartoform = document.querySelector('#repartoform');

    addreparto.addEventListener('click',( ) => {                
        document.querySelector('#codice').value = '';         
        document.querySelector('#descrizione').value = '';
        document.querySelector('#posizione').value = '0';                 
        document.querySelector('#attivo').checked = true;
        repartoform.action = '/repartoinsert';
        savereparto.innerHTML = 'Inserisci';
    });

    function schedaRep(id)
    {
        fetch('/api/reparto/'+id)
        .then((response) => {
            return response.json();
        }).then((resp) => {            
            document.querySelector('#codice').value = resp['codice'];             
            document.querySelector('#descrizione').value = resp['descrizione']; 
            document.querySelector('#posizione').value = resp['posizione'];             
            (resp['attivo'] == '1') ? document.getElementById('attivo').checked = true :     document.getElementById('attivo').checked =  false ;            
            repartoform.action = '/repartoupdate/'+id;
            savereparto.innerHTML = 'Modifica';
        });
    }
}

/**  GESTIONE CASSIERI  */

const savecassiere = document.querySelector('#savecassiere');

if (savecassiere){    
    const addcassiere = document.querySelector('#addcassiere');    
    const cassiereform = document.querySelector('#cassiereform');

    addcassiere.addEventListener('click',( ) => {                
        document.querySelector('#codice').value = '';         
        document.querySelector('#descrizione').value = '';
        document.querySelector('#barcode').value = '';                 
        document.querySelector('#password').value = '';
        document.querySelector('#attivo').checked = true;
        //document.querySelector('#id_profilo').value = '0'; 
        cassiereform.action = '/cassiereinsert';
        savecassiere.innerHTML = 'Inserisci';
    });

    function schedaCas(id)
    {
        fetch('/api/cassiere/'+id)
        .then((response) => {
            return response.json();
        }).then((resp) => {            
            document.querySelector('#codice').value = resp['codice'];             
            document.querySelector('#descrizione').value = resp['descrizione']; 
            document.querySelector('#barcode').value = resp['barcode'];             
            document.querySelector('#password').value = resp['password'];              
            (resp['visibile_cassa'] == '1') ? document.getElementById('visibile_cassa').checked = true : document.getElementById('visibile_cassa').checked =  false ;            
            (resp['visibile_frontend'] == '1') ? document.getElementById('visibile_frontend').checked = true : document.getElementById('visibile_frontend').checked =  false ;                                                        
            (resp['attivo'] == '1') ? document.getElementById('attivo').checked = true : document.getElementById('attivo').checked =  false ;            
            // document.querySelector('#id_profilo').value = resp['id_profilo'];
            cassiereform.action = '/cassiereupdate/'+id;
            savecassiere.innerHTML = 'Modifica';
        });
    }
}

/**  GESTIONE PROFILI  */

const saveprofilo = document.querySelector('#saveprofilo');

if (saveprofilo){    
    const addprofilo = document.querySelector('#addprofilo');    
    const profiloform = document.querySelector('#profiloform');

    addprofilo.addEventListener('click',( ) => {                
        document.querySelector('#codice').value = '';         
        document.querySelector('#descrizione').value = '';        
        profiloform.action = '/profiloinsert';
        saveprofilo.innerHTML = 'Inserisci';
    });

    function schedaPro(id)
    {
        fetch('/api/profilo/'+id)
        .then((response) => {
            return response.json();
        }).then((resp) => {            
            document.querySelector('#codice').value = resp['codice'];             
            document.querySelector('#descrizione').value = resp['descrizione'];                         
            (resp['dashboard'] == '1') ? document.getElementById('dashboard').checked = true : document.getElementById('dashboard').checked =  false ;            
            (resp['anagrafiche'] == '1') ? document.getElementById('anagrafiche').checked = true : document.getElementById('anagrafiche').checked =  false ;            
            (resp['cassieri'] == '1') ? document.getElementById('cassieri').checked = true : document.getElementById('cassieri').checked =  false ;            

            (resp['versamenti'] == '1') ? document.getElementById('versamenti').checked = true : document.getElementById('versamenti').checked =  false ;            
            (resp['prelievi'] == '1') ? document.getElementById('prelievi').checked = true : document.getElementById('prelievi').checked =  false ;            
            (resp['richiama_scontrino'] == '1') ? document.getElementById('richiama_scontrino').checked = true : document.getElementById('richiama_scontrino').checked =  false ;            
            (resp['sconti'] == '1') ? document.getElementById('sconti').checked = true : document.getElementById('sconti').checked =  false ;            
            (resp['correzioni'] == '1') ? document.getElementById('correzioni').checked = true : document.getElementById('correzioni').checked =  false ;            
            (resp['annulla_scontrino'] == '1') ? document.getElementById('annulla_scontrino').checked = true : document.getElementById('annulla_scontrino').checked =  false ;            
            (resp['reso'] == '1') ? document.getElementById('reso').checked = true : document.getElementById('reso').checked =  false ;            
            (resp['preconto'] == '1') ? document.getElementById('preconto').checked = true : document.getElementById('preconto').checked =  false ;            
            (resp['gestione_fiscale'] == '1') ? document.getElementById('gestione_fiscale').checked = true : document.getElementById('gestione_fiscale').checked =  false ;            
            (resp['rapporti'] == '1') ? document.getElementById('rapporti').checked = true : document.getElementById('rapporti').checked =  false ;            
            (resp['scarico'] == '1') ? document.getElementById('scarico').checked = true : document.getElementById('scarico').checked =  false ;            
            (resp['fattura'] == '1') ? document.getElementById('fattura').checked = true : document.getElementById('fattura').checked =  false ;            
            (resp['scontrino'] == '1') ? document.getElementById('scontrino').checked = true : document.getElementById('scontrino').checked =  false ;

            profiloform.action = '/profiloupdate/'+id;
            saveprofilo.innerHTML = 'Modifica';
        });
    }
}

let imp_vol = document.querySelector('#importa_volantino');
let del_vol = document.querySelector('#elimina_volantino');
let del = document.querySelector('#delete');
imp_vol.addEventListener('click',() => {
    del.value = '0';    
   document.querySelector('#myform').submit();
});

del_vol.addEventListener('click',() => {
    del.value = '1';    
   document.querySelector('#myform').submit();
});

$(document).ready(function() {
    $('#alert').fadeOut(3000);
});




