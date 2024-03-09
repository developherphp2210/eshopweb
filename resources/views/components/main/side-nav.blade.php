<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">                
                <!-- Sidenav Menu Heading (Core)-->
                <div class="sidenav-menu-heading">Principale</div>
                <!-- Sidenav Accordion (Dashboard)-->                
                <a class="nav-link {{($index == '1') ? 'active' : ''}}" href="{{url('/dashboard')}}">
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
                <div class="collapse {{( ($index > '1') && ($index < '9') ) ? 'show' : ''}}" id="collapsePages" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">                        
                        <a class="nav-link {{($index == '2') ? 'active' : ''}}" href="{{url('/clienti')}}">Fidelity</a>
                        <a class="nav-link {{($index == '3') ? 'active' : ''}}" href="{{url('/articoli')}}">Articoli</a>
                        <a class="nav-link {{($index == '4') ? 'active' : ''}}" href="{{url('/reparti')}}">Reparti</a>
                        <a class="nav-link {{($index == '5') ? 'active' : ''}}" href="{{url('/iva')}}">Aliquote IVA</a>

                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#OperatoriPages" aria-expanded="false" aria-controls="OperatoriPages">
                            <div class="nav-link-icon"><i data-feather="corner-right-down"></i></div>
                            Gestione Cassieri
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{( ($index > '5') && ($index < '8') ) ? 'show' : ''}}" id="OperatoriPages" data-bs-parent="#accordionSidenav2">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">                        
                                <a class="nav-link {{($index == '6') ? 'active' : ''}}" href="{{url('/cassieri')}}">Cassieri</a>
                                <a class="nav-link {{($index == '7') ? 'active' : ''}}" href="{{url('/profili')}}">Profili</a>                                                                
                            </nav>
                        </div>

                    </nav>
                </div>                
                <!-- Sidenav Heading (UI Toolkit)-->
                <div class="sidenav-menu-heading">Promozioni</div>
                <a class="nav-link" href="{{url('/promotions')}}">
                    <div class="nav-link-icon"><i data-feather="book-open"></i></div>
                    Volantino                    
                </a> 
                <!-- Sidenav Accordion (Layout)-->
                
                <div class="sidenav-menu-heading">Statistiche</div>
                
            </div>
        </div>
        <!-- Sidenav Footer-->
        <div class="sidenav-footer">
            <div class="sidenav-footer-content">
                <div class="sidenav-footer-subtitle">Utente:</div>
                <div class="sidenav-footer-title">{{session('user')->user_name}}</div>
            </div>
        </div>
    </nav>
</div>