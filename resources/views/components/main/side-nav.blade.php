<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <!-- Sidenav Menu Heading (Account)-->
                <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                <div class="sidenav-menu-heading d-sm-none">Account</div>
                <!-- Sidenav Link (Alerts)-->
                <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                <a class="nav-link d-sm-none" href="#!">
                    <div class="nav-link-icon"><i data-feather="bell"></i></div>
                    Alerts
                    <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
                </a>
                <!-- Sidenav Link (Messages)-->
                <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                <a class="nav-link d-sm-none" href="#!">
                    <div class="nav-link-icon"><i data-feather="mail"></i></div>
                    Messages
                    <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
                </a>
                <!-- Sidenav Menu Heading (Core)-->
                <div class="sidenav-menu-heading">Principale</div>
                <!-- Sidenav Accordion (Dashboard)-->                
                <a class="nav-link" href="{{url('/dashboard')}}">
                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                    Dashboards                    
                </a> 

                <!-- Sidenav Heading (App Views)-->
                <div class="sidenav-menu-heading">Gestionale</div>
                <!-- Sidenav Accordion (Pages)-->
                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="nav-link-icon"><i data-feather="users"></i></div>
                    Anagrafiche
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">                        
                        <a class="nav-link" href="{{url('/customers')}}">Fidelity</a>
                        <a class="nav-link" href="{{url('/articles')}}">Articoli</a>
                        <a class="nav-link" href="{{url('/departments')}}">Reparti</a>
                        <a class="nav-link" href="{{url('/vats')}}">Aliquote IVA</a>
                    </nav>
                </div>                
                <!-- Sidenav Heading (UI Toolkit)-->
                <div class="sidenav-menu-heading">Attività</div>
                <!-- Sidenav Accordion (Layout)-->
                
                <div class="sidenav-menu-heading">Statistiche</div>
                
            </div>
        </div>
        <!-- Sidenav Footer-->
        <div class="sidenav-footer">
            <div class="sidenav-footer-content">
                <div class="sidenav-footer-subtitle">Utente:</div>
                <div class="sidenav-footer-title">{{$user->user_name}}</div>
            </div>
        </div>
    </nav>
</div>