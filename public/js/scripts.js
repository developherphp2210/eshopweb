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

// PAGINA RICERCA ARTICOLI

const mysearch = document.querySelector('#mysearch');
const departmentList = document.querySelector('#departmentList');


if (mysearch){
    
    function schedaArt(id){        
        window.location.href='/article/'+id+'/1';
    }

    departmentList.addEventListener('change',() => {
        document.getElementById('myform').submit();
    });
}


/**  GESTIONE ALIQUOTE IVA  */

const saveiva = document.querySelector('#saveiva');

if (saveiva){    
    
    const ivaform = document.querySelector('#ivaform');


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
        
    const repartoform = document.querySelector('#repartoform');

    
    function schedaRep(id)
    {
        fetch('/api/reparto/'+id)
        .then((response) => {
            return response.json();
        }).then((resp) => {            
            document.querySelector('#codice').value = resp['codice'];             
            document.querySelector('#descrizione').value = resp['descrizione']; 
            (resp['visibile'] == '1') ? document.getElementById('visibile').checked = true :     document.getElementById('visibile').checked =  false ;            
            (resp['attivo'] == '1') ? document.getElementById('attivo').checked = true :     document.getElementById('attivo').checked =  false ;            
            repartoform.action = '/repartoupdate/'+id;
            savereparto.innerHTML = 'Salva';
        });
    }
}

/**  GESTIONE CASSIERI  */

const savecassiere = document.querySelector('#savecassiere');

if (savecassiere){    
    const addcassiere = document.querySelector('#addcassiere');    
    const cassiereform = document.querySelector('#cassiereform');

    addcassiere.addEventListener('click',( ) => {                                 
        document.querySelector('#descrizione').value = '';
        document.querySelector('#barcode').value = '';                 
        document.querySelector('#password').value = '';
        document.querySelector('#attivo').checked = true;
        document.querySelector('#id_profilo').value = '0'; 
        document.querySelector('#id_deposito').value = '0';
        document.getElementById('visibile_cassa').checked =  false ;                                                        
        document.getElementById('visibile_frontend').checked =  false ;                                                        
        document.getElementById('visibile_frontend').disabled = false;
        document.querySelector('#password').readOnly = false;
        document.querySelector('#codice').focus();
        cassiereform.action = '/cassiereinsert';
        savecassiere.innerHTML = 'Inserisci';
    });

    function schedaCas(id)
    {
        fetch('/api/cassiere/'+id)
        .then((response) => {
            return response.json();
        }).then((resp) => {                                   
            document.querySelector('#descrizione').value = resp['descrizione']; 
            document.querySelector('#barcode').value = resp['barcode'];             
            document.querySelector('#password').value = resp['password'];              
            (resp['visibile_cassa'] == '1') ? document.getElementById('visibile_cassa').checked = true : document.getElementById('visibile_cassa').checked =  false ;            
            if (resp['visibile_frontend'] == '1'){
                document.getElementById('visibile_frontend').checked = true;
                document.getElementById('visibile_frontend').disabled = true;
                document.querySelector('#password').readOnly = true;
            } else {
                document.getElementById('visibile_frontend').checked =  false ;                                                        
                document.getElementById('visibile_frontend').disabled = false;
                document.querySelector('#password').readOnly = false;
            }
            (resp['attivo'] == '1') ? document.getElementById('attivo').checked = true : document.getElementById('attivo').checked =  false ;            
            document.querySelector('#id_profilo').value = resp['id_profilo'];            
            document.querySelector('#id_deposito').value = resp['id_deposito'];
            cassiereform.action = '/cassiereupdate/'+id;
            savecassiere.innerHTML = 'Salva';
        });
    }
}

/**  GESTIONE PROFILI  */

const saveprofilo = document.querySelector('#saveprofilo');

if (saveprofilo){    
    const addprofilo = document.querySelector('#addprofilo');    
    const profiloform = document.querySelector('#profiloform');

    addprofilo.addEventListener('click',( ) => { 
        document.querySelector('#id').value = '';                                
        document.querySelector('#descrizione').value = ''; 
        document.querySelector('#descrizione').focus();      
        profiloform.action = '/profiloinsert';
        saveprofilo.innerHTML = 'Inserisci';
    });

    function schedaPro(id)
    {
        fetch('/api/profilo/'+id)
        .then((response) => {
            return response.json();
        }).then((resp) => {                                   
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
            saveprofilo.innerHTML = 'Salva';
        });
    }
}

/**  GESTIONE SCONTI  */

const savesconto = document.querySelector('#savesconto');

if (savesconto){    
    const addsconto = document.querySelector('#addsconto');    
    const scontoform = document.querySelector('#scontoform');

    addsconto.addEventListener('click',( ) => { 
        document.querySelector('#id').value = '';                              
        document.querySelector('#descrizione').value = '';
        document.querySelector('#tipo').value = 0;                 
        document.querySelector('#valore').value = 0;
        document.querySelector('#attivo').checked = true;
        scontoform.action = '/scontoinsert';
        savesconto.innerHTML = 'Inserisci';
        document.querySelector('#descrizione').focus();  
    });

    function schedaSco(id)
    {
        fetch('/api/sconto/'+id)
        .then((response) => {
            return response.json();
        }).then((resp) => {                        
            document.querySelector('#id').value = resp['id'];
            document.querySelector('#descrizione').value = resp['descrizione']; 
            document.querySelector('#tipo').value = resp['tipo']; 
            document.querySelector('#valore').value = resp['valore'];             
            (resp['attivo'] == '1') ? document.getElementById('attivo').checked = true :     document.getElementById('attivo').checked =  false ;            
            scontoform.action = '/scontoupdate/'+id;
            savesconto.innerHTML = 'Salva';
        });
    }
}

/**  GESTIONE PAGAMENTI  */

const savepagamento = document.querySelector('#savepagamento');

if (savepagamento){    
    const addpagamento = document.querySelector('#addpagamento');    
    const pagamentoform = document.querySelector('#pagamentoform');

    addpagamento.addEventListener('click',( ) => {
        document.querySelector('#id').value = '';
        document.querySelector('#descrizione').value = '';        
        document.querySelector('#attivo').checked = true;
        document.querySelector('#tipologia').value = 0;            
        document.querySelector('#tipo_rt').value = 0;            
        document.querySelector('#codice_sdi').value = 0;  
        pagamentoform.action = '/pagamentoinsert';
        savepagamento.innerHTML = 'Inserisci';
        document.querySelector('#descrizione').focus();  
    });

    function schedaPag(id)
    {
        fetch('/api/pagamento/'+id)
        .then((response) => {
            return response.json();
        }).then((resp) => {                                    
            document.querySelector('#id').value = resp['id'];             
            document.querySelector('#descrizione').value = resp['descrizione'];             
            (resp['attivo'] == '1') ? document.getElementById('attivo').checked = true :     document.getElementById('attivo').checked =  false ;            
            document.querySelector('#tipologia').value = resp['tipologia'];            
            document.querySelector('#tipo_rt').value = resp['tipo_rt'];            
            document.querySelector('#codice_sdi').value = resp['codice_sdi'];            
            pagamentoform.action = '/pagamentoupdate/'+id;
            savepagamento.innerHTML = 'Salva';
        });
    }
}

/**  GESTIONE CAUSALI  */

const savecausale = document.querySelector('#savecausale');

if (savecausale){    
    const addcausale = document.querySelector('#addcausale');    
    const causaleform = document.querySelector('#causaleform');

    addcausale.addEventListener('click',( ) => {                
        document.querySelector('#codice').value = '';         
        document.querySelector('#descrizione').value = '';        
        document.querySelector('#attivo').checked = true;
        document.querySelector('#type').value = 0;                    
        causaleform.action = '/causaleinsert';
        savecausale.innerHTML = 'Inserisci';
        document.querySelector('#codice').focus();  
    });

    function schedaCau(id)
    {
        fetch('/api/causale/'+id)
        .then((response) => {
            return response.json();
        }).then((resp) => {            
            document.querySelector('#codice').value = resp['codice'];             
            document.querySelector('#descrizione').value = resp['descrizione'];             
            (resp['attivo'] == '1') ? document.getElementById('attivo').checked = true :     document.getElementById('attivo').checked =  false ;            
            document.querySelector('#type').value = resp['type'];                        
            causaleform.action = '/causaleupdate/'+id;
            savecausale.innerHTML = 'Salva';
        });
    }
}

/**  GESTIONE DEPOSITI  */

const listadeposito = document.querySelector('#listadeposito');

if (listadeposito){    
    depositoform = document.querySelector('#depositoform');
    function schedaDep(id)
    {
        fetch('/api/deposito/'+id)
        .then((response) => {
            return response.json();
        }).then((resp) => {            
            document.querySelector('#codice').value = resp['codice'];             
            document.querySelector('#descrizione').value = resp['descrizione'];             
            document.querySelector('#id_listino').value = resp['id_listino'];
            document.querySelector('#riga1').value = resp['riga1'];
            document.querySelector('#riga2').value = resp['riga2'];
            document.querySelector('#riga3').value = resp['riga3'];
            document.querySelector('#riga4').value = resp['riga4'];
            document.querySelector('#riga5').value = resp['riga5'];
            document.querySelector('#riga6').value = resp['riga6'];
            depositoform.action = '/depositoupdate/'+id;
            // savecausale.innerHTML = 'Salva';
        });
    }
}

/**  GESTIONE CASSE  */

const savecassa = document.querySelector('#savecassa');

if (savecassa){    
    const addcassa = document.querySelector('#addcassa');    
    const cassaform = document.querySelector('#cassaform');
console.log('qui');
    addcassa.addEventListener('click',( ) => {                
        document.querySelector('#codice').value = '';         
        document.querySelector('#descrizione').value = '';        
        document.querySelector('#id_deposito').value = 0;
        cassaform.action = '/cassainsert';
        savecassa.innerHTML = 'Inserisci';
        document.querySelector('#codice').focus();  
    });

    function schedaCas(id)
    {
        fetch('/api/cassa/'+id)
        .then((response) => {
            return response.json();
        }).then((resp) => {            
            document.querySelector('#codice').value = resp['codice'];             
            document.querySelector('#descrizione').value = resp['descrizione'];                         
            document.querySelector('#id_deposito').value = resp['id_deposito'];                        
            cassaform.action = '/cassaupdate/'+id;
            savecassa.innerHTML = 'Salva';
        });
    }
}

// let imp_vol = document.querySelector('#importa_volantino');
// let del_vol = document.querySelector('#elimina_volantino');
// let del = document.querySelector('#delete');
// imp_vol.addEventListener('click',() => {
//     del.value = '0';    
//    document.querySelector('#myform').submit();
// });

// del_vol.addEventListener('click',() => {
//     del.value = '1';    
//    document.querySelector('#myform').submit();
// });

$(document).ready(function() {
    $('#alert').fadeOut(3000);
});

/**  GESTIONE LINEA FIDELITY  */

const savelineafid = document.querySelector('#savelineafid');

if (savelineafid){    
    const addlineafid = document.querySelector('#addlineafid');    
    const lineafidform = document.querySelector('#lineafidform');
    const generafidelity = document.querySelector('#generafidelity');
    const gencli = document.querySelector('#gencli');
    const mostralistino = document.querySelector('#mostralistino');
    const listino = document.querySelector('#listino');    

    addlineafid.addEventListener('click',( ) => {                
        document.querySelector('#codice').value = '';         
        document.querySelector('#descrizione').value = '';        
        document.querySelector('#attivo').checked = true;
        document.querySelector('#generati').value = '';        
        
        lineafidform.action = '/lineafidinsert';
        savelineafid.innerHTML = 'Inserisci';
        document.querySelector('#codice').focus();  
    });

    function schedaLinea(id)
    {
        fetch('/api/lineafidelity/'+id)
        .then((response) => {
            return response.json();
        }).then((resp) => {            
            document.querySelector('#codice').value = resp['codice'];             
            document.querySelector('#descrizione').value = resp['descrizione'];             
            document.querySelector('#generati').value = resp['generati'];
            (resp['attivo'] == '1') ? document.getElementById('attivo').checked = true :     document.getElementById('attivo').checked =  false ;                                               
            lineafidform.action = '/lineafidupdate/'+id;
            generafidelity.action = '/generazionefidelity/'+id;
            savelineafid.innerHTML = 'Salva';
        });
    }
    
    gencli.addEventListener('click', (event) => {
        if(gencli.checked){
            mostralistino.classList.remove('d-none');
            listino.setAttribute('required','');
        }else{
            mostralistino.classList.add('d-none');
            listino.removeAttribute('required');
        }
    })
}

const savepromo = document.querySelector('#savepromo');

if (savepromo){    
    const addpromo = document.querySelector('#addpromo');    
    const promoform = document.querySelector('#promoform');    

    addpromo.addEventListener('click',( ) => { 
        data = new Date();        
        document.querySelector('#id').value = '';         
        document.querySelector('#descrizione').value = '';        
        document.querySelector('#id_deposito').value = 0;
        document.querySelector('#data_inizio').value = '';
        document.querySelector('#data_fine').value = '';
        
        promoform.action = '/promoinsert';
        savepromo.innerHTML = 'Inserisci';
        document.querySelector('#descrizione').focus();  
    });

    function schedaPromo(id)
    {
        fetch('/api/promo/'+id)
        .then((response) => {
            return response.json();
        }).then((resp) => {            
            document.querySelector('#id').value = resp['id'];             
            document.querySelector('#descrizione').value = resp['descrizione'];                         
            document.querySelector('#id_deposito').value = resp['id_deposito'];
            document.querySelector('#data_inizio').value = resp['data_inizio'];
            document.querySelector('#data_fine').value = resp['data_fine'];
            promoform.action = '/promoupdate/'+id;            
            savepromo.innerHTML = 'Salva';
        });
    }
    
    gencli.addEventListener('click', (event) => {
        if(gencli.checked){
            mostralistino.classList.remove('d-none');
            listino.setAttribute('required','');
        }else{
            mostralistino.classList.add('d-none');
            listino.removeAttribute('required');
        }
    })
}

function openfidelitymodal(id){
    const fidelityID = document.querySelector('#fidelityID');
    fidelityID.value = id;
}

function associaclientefidelity(id){
    const formfidelity = document.querySelector('#formfidelity');
    const clienteID = document.querySelector('#clienteID');
    clienteID.value = id;
    formfidelity.submit();
}

function visualizzaSco(id){
    fetch('/api/singolatransazione/'+id)
        .then((response) => {
            return response.json();
        }).then((resp) => {            
            totale = 0; 
            const corposcontrino = document.querySelector('#corposcontrino');
            corposcontrino.innerHTML = '';
            document.querySelector('#ModalLabel').innerHTML = 'Scontrino n° '+resp['testata']['numero_scontrino'];
            if (resp['fidelity'].length > 0 )
            {
                div = document.createElement('div');
                resp['fidelity'].forEach( element => {
                    div.innerHTML = '<h6>'+element['descrizione']+'</h6>'+
                                    '<h6>'+element['promo']+'</h6>'+
                                    '<h6>Punti Precedenti: '+element['punti_precedenti']+'</h6>'+
                                    '<h6>Punti Maturati: '+element['punti_accumulati']+'</h6>'+
                                    '<h6>Punti Jolly: '+element['punti_jolly']+'</h6>'+
                                    '<h6>Totale Punti :'+element['totpunti']+'</h6>'+
                                    '<br></br>';
                corposcontrino.append(div);                    
                });
            }
            resp['corpo'].forEach( value => {                                
                if (value['causale'] == 'R'){
                    h5r = document.createElement('h5');                
                    h5r.innerHTML = '*****RESO****';
                    corposcontrino.append(h5r);
                }
                if (value['quantita'] > 1){
                    h6 = document.createElement('h6');
                    h6.innerHTML = value['quantita']+' X '+parseFloat(value['prezzo_lordo']).toFixed(2).replace('.',',');                
                    corposcontrino.append(h6);
                }
                div = document.createElement('div');                    
                div.classList.add('d-flex');
                div.classList.add('justify-content-between');                
                h51 = document.createElement('h5');                
                h51.innerHTML = value['descrizione'];                
                h52 = document.createElement('h5');
                h52.innerHTML = parseFloat((value['prezzo_lordo'] * value['quantita'])).toFixed(2).replace('.',',');
                if (value['causale'] == 'R'){
                    totale = totale - (value['prezzo_lordo'] * value['quantita']);
                } else {
                    totale = totale + (value['prezzo_lordo'] * value['quantita']);
                }
                div.append(h51);
                div.append(h52);
                corposcontrino.append(div);
                if (value['presenza_sconto'] = 1){
                    sconto = resp['sconti'].filter(({id_corpo})  => 
                        id_corpo === value['id']
                    );
                    sconto.forEach( element => {
                        div2 = document.createElement('div');                    
                        div2.classList.add('d-flex');
                        div2.classList.add('justify-content-between');                
                        h5s1 = document.createElement('h5');
                        h5s1.innerHTML = element['descrizione'];
                        h5s2 = document.createElement('h5');
                        h5s2.innerHTML = '- '+parseFloat(element['importo']).toFixed(2).replace('.',',');
                        totale = totale - element['importo'];
                        div2.append(h5s1);
                        div2.append(h5s2);
                        corposcontrino.append(div2);
                    });                    
                }                                                    
            });
            br = document.createElement('br');            
            corposcontrino.append(br);
            divsb = document.createElement('div');                    
            divsb.classList.add('d-flex');
            divsb.classList.add('justify-content-between');
            h3 = document.createElement('h3');
            h3.innerHTML = 'SUBTOTALE';
            h31 = document.createElement('h3');
            h31.innerHTML = parseFloat(totale).toFixed(2).replace('.',',');
            divsb.append(h3);
            divsb.append(h31);
            corposcontrino.append(divsb);
            sconto = resp['sconti'].filter(({id_corpo})  => 
                id_corpo === 0
            );
            if (sconto){
                sconto.forEach( element => {
                    div2 = document.createElement('div');                    
                    div2.classList.add('d-flex');
                    div2.classList.add('justify-content-between');                
                    h5s1 = document.createElement('h5');
                    h5s1.innerHTML = element['descrizione'];
                    h5s2 = document.createElement('h5');
                    h5s2.innerHTML = '- '+parseFloat(element['importo']).toFixed(2).replace('.',',');
                    div2.append(h5s1);
                    div2.append(h5s2);
                    corposcontrino.append(div2);
                }); 
            }
            br = document.createElement('br');            
            corposcontrino.append(br);
            divt = document.createElement('div');                    
            divt.classList.add('d-flex');
            divt.classList.add('justify-content-between');
            h21 = document.createElement('h2');
            h21.innerHTML = 'TOTALE';
            h22 = document.createElement('h2');
            h22.innerHTML = parseFloat(resp['testata']['importo']).toFixed(2).replace('.',',');
            divt.append(h21);
            divt.append(h22);
            corposcontrino.append(divt);            
            resp['pagamenti'].forEach( element => {
                divp = document.createElement('div');                    
                divp.classList.add('d-flex');
                divp.classList.add('justify-content-between');                
                h5p1 = document.createElement('h5');
                h5p1.innerHTML = element['descrizione'];
                h5p2 = document.createElement('h5');
                h5p2.innerHTML = parseFloat(element['importo']).toFixed(2).replace('.',',');
                divp.append(h5p1);
                divp.append(h5p2);
                corposcontrino.append(divp);
            });
            br = document.createElement('br');            
            corposcontrino.append(br);
            div = document.createElement('div');                    
            div.classList.add('d-flex');
            div.classList.add('justify-content-between');
            h61 = document.createElement('h6');
            data = new Date(resp['testata']['data']);
            h61.innerHTML = data.getDate()+'/'+(data.getMonth() + 1) +'/'+data.getFullYear()+' '+data.getHours()+':'+data.getMinutes();
            h62 = document.createElement('h6');
            h62.innerHTML = resp['testata']['numero_chiusura']+' - '+resp['testata']['numero_scontrino'];            
            div.append(h61);
            div.append(h62);
            corposcontrino.append(div);
            br = document.createElement('br');            
            corposcontrino.append(br);
            h6 = document.createElement('h6');
            h6.classList.add('text-center');
            h6.innerHTML = resp['testata']['matricola_fiscale'];
            corposcontrino.append(h6);
            h6 = document.createElement('h6');
            h6.innerHTML = resp['testata']['cassa']+' - Cassiere: '+resp['testata']['operatore']
            corposcontrino.append(h6);
        });   
}

function visualizzaFat(id){
    fetch('/api/singolafattura/'+id)
        .then((response) => {
            return response.json();
        }).then((resp) => {
            totale = 0; 
            const corposcontrino = document.querySelector('#corposcontrino');
            corposcontrino.innerHTML = '';
            document.querySelector('#ModalLabel').innerHTML = 'Fattura n° '+resp['testata']['numero_fattura']+'/'+resp['testata']['registro_fattura'];
            br = document.createElement('br');            
            corposcontrino.append(br);
            div = document.createElement('div');                                
            div.innerHTML = '<div><h6 class="text-center">'+resp['cliente']['ragsoc']+'</h6></div>'
                            +'<div><h6 class="text-center">'+resp['cliente']['indirizzo']+'</h6></div>'
                            +'<div><h6 class="text-center">'+resp['cliente']['cap']+' '+resp['cliente']['citta']+'  ('+resp['cliente']['prov']+')</h6></div>'
                            +'<div><h6 class="text-center">'+resp['cliente']['piva']+'</h6></div>'
                            +'<div><h6 class="text-center">'+resp['cliente']['codfisc']+'</h6></div>'
                            +'<div><h6 class="text-center">'+resp['cliente']['sdi']+'</h6></div>'
                            +'<div><h6 class="text-center">'+resp['cliente']['pec']+'</h6></div>';            
            corposcontrino.append(div);
            br = document.createElement('br');            
            corposcontrino.append(br);
            data = new Date(resp['testata']['data']);
            div = document.createElement('div');                                
            div.innerHTML = '<div><h6>Fattura numero : '+resp['testata']['numero_fattura']+'/'+resp['testata']['registro_fattura']+'</h6></div>'
                            +'<div><h6>Data Fattura : '+data.getDate()+'/'+(data.getMonth() + 1) +'/'+data.getFullYear()+'</h6></div>';
            corposcontrino.append(div);
            br = document.createElement('br');            
            corposcontrino.append(br);
            resp['corpo'].forEach( value => {                                
                if (value['causale'] == 'R'){
                    h5r = document.createElement('h5');                
                    h5r.innerHTML = '*****RESO****';
                    corposcontrino.append(h5r);
                }
                if (value['quantita'] > 1){
                    h6 = document.createElement('h6');
                    h6.innerHTML = value['quantita']+' X '+parseFloat(value['prezzo_lordo']).toFixed(2).replace('.',',');                
                    corposcontrino.append(h6);
                }
                div = document.createElement('div');                    
                div.classList.add('d-flex');
                div.classList.add('justify-content-between');                
                h51 = document.createElement('h5');                
                h51.innerHTML = value['descrizione'];                
                h52 = document.createElement('h5');
                h52.innerHTML = parseFloat((value['prezzo_lordo'] * value['quantita'])).toFixed(2).replace('.',',');
                if (value['causale'] == 'R'){
                    totale = totale - (value['prezzo_lordo'] * value['quantita']);
                } else {
                    totale = totale + (value['prezzo_lordo'] * value['quantita']);
                }
                div.append(h51);
                div.append(h52);
                corposcontrino.append(div);
                if (value['presenza_sconto'] = 1){
                    sconto = resp['sconti'].filter(({id_corpo})  => 
                        id_corpo === value['id']
                    );
                    sconto.forEach( element => {
                        div2 = document.createElement('div');                    
                        div2.classList.add('d-flex');
                        div2.classList.add('justify-content-between');                
                        h5s1 = document.createElement('h5');
                        h5s1.innerHTML = element['descrizione'];
                        h5s2 = document.createElement('h5');
                        h5s2.innerHTML = '- '+parseFloat(element['importo']).toFixed(2).replace('.',',');
                        totale = totale - element['importo'];
                        div2.append(h5s1);
                        div2.append(h5s2);
                        corposcontrino.append(div2);
                    });                    
                }                                                    
            });
            br = document.createElement('br');            
            corposcontrino.append(br);
            divsb = document.createElement('div');                    
            divsb.classList.add('d-flex');
            divsb.classList.add('justify-content-between');
            h3 = document.createElement('h3');
            h3.innerHTML = 'SUBTOTALE';
            h31 = document.createElement('h3');
            h31.innerHTML = parseFloat(totale).toFixed(2).replace('.',',');
            divsb.append(h3);
            divsb.append(h31);
            corposcontrino.append(divsb);
            sconto = resp['sconti'].filter(({id_corpo})  => 
                id_corpo === 0
            );
            if (sconto){
                sconto.forEach( element => {
                    div2 = document.createElement('div');                    
                    div2.classList.add('d-flex');
                    div2.classList.add('justify-content-between');                
                    h5s1 = document.createElement('h5');
                    h5s1.innerHTML = element['descrizione'];
                    h5s2 = document.createElement('h5');
                    h5s2.innerHTML = '- '+parseFloat(element['importo']).toFixed(2).replace('.',',');
                    div2.append(h5s1);
                    div2.append(h5s2);
                    corposcontrino.append(div2);
                }); 
            }
            br = document.createElement('br');            
            corposcontrino.append(br);
            divt = document.createElement('div');                    
            divt.classList.add('d-flex');
            divt.classList.add('justify-content-between');
            h21 = document.createElement('h2');
            h21.innerHTML = 'TOTALE';
            h22 = document.createElement('h2');
            h22.innerHTML = parseFloat(resp['testata']['importo']).toFixed(2).replace('.',',');
            divt.append(h21);
            divt.append(h22);
            corposcontrino.append(divt);            
            resp['pagamenti'].forEach( element => {
                divp = document.createElement('div');                    
                divp.classList.add('d-flex');
                divp.classList.add('justify-content-between');                
                h5p1 = document.createElement('h5');
                h5p1.innerHTML = element['descrizione'];
                h5p2 = document.createElement('h5');
                h5p2.innerHTML = parseFloat(element['importo']).toFixed(2).replace('.',',');
                divp.append(h5p1);
                divp.append(h5p2);
                corposcontrino.append(divp);
            });
            br = document.createElement('br');            
            corposcontrino.append(br);
            div = document.createElement('div');
            div.innerHTML = '<h6>--------------------------------------------------------------</h6>'+         
                            '<h6 class="text-center">                      DETTAGLIO IVA</h6>'+
                            '<div class="d-flex justify-content-between">'+
                            '<h6>Descrizione</h6><h6>Imponibile</h6><h6>Aliquota</h6><h6>Iva</h6></div>'+
                            '<h6>--------------------------------------------------------------</h6>';
            corposcontrino.append(div);
            resp['iva'].forEach( value => {
                var aliquota = value['importo'] - (value['importo'] / (1 + (value['aliquota'] / 100) ) );
                var imponibile = value['importo'] - aliquota;
                const div = document.createElement('div');
                div.classList.add('d-flex');
                div.classList.add('justify-content-between');
                div.innerHTML = '<h6>'+value['descrizione']+'</h6><h6>'+parseFloat(imponibile).toFixed(2)+'</h6><h6>'+value['aliquota']+'</h6><h6>'+parseFloat(aliquota).toFixed(2)+'</h6>';
                corposcontrino.append(div);
            });
            br = document.createElement('br');            
            corposcontrino.append(br);
            h6 = document.createElement('h6');
            h6.innerHTML = resp['testata']['cassa']+' - Cassiere: '+resp['testata']['operatore']
            corposcontrino.append(h6);
        });
}



