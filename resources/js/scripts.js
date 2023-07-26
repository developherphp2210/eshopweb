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

$(document).ready(function() {
    $('#alert').fadeOut(3000);
});




