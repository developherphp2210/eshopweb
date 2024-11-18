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
                <a class="nav-link {{( ($index > '1') && ($index < '21') ) ? 'active' : 'collapsed'}}" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseAnagrafiche" aria-expanded="false" aria-controls="collapseAnagrafiche">
                    <div class="nav-link-icon"><i data-feather="users"></i></div>
                    Anagrafiche
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{( ($index > '1') && ($index < '21') ) ? 'show' : ''}}" id="collapseAnagrafiche" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion">                        
                        <a class="nav-link {{($index == '2') ? 'active' : ''}}" href="{{url('/clienti')}}">Clienti / Fidelity Card</a>
                        <a class="nav-link {{($index == '3') ? 'active' : ''}}" href="{{url('/articoli')}}">Articoli</a>
                        <a class="nav-link {{($index == '4') ? 'active' : ''}}" href="{{url('/reparti')}}">Reparti</a>
                        <a class="nav-link {{($index == '5') ? 'active' : ''}}" href="{{url('/iva')}}">Aliquote IVA</a>
                        <a class="nav-link {{( ($index > '5') && ($index < '8') ) ? 'active' : 'collapsed'}}" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#OperatoriPages" aria-expanded="false" aria-controls="OperatoriPages">
                            <div id="accordionSidenav2"></div>
                            Gestione Cassieri
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{( ($index > '5') && ($index < '8') ) ? 'show' : ''}}" id="OperatoriPages" data-bs-parent="#accordionSidenav2">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">                        
                                <a class="nav-link {{($index == '6') ? 'active' : ''}}" href="{{url('/cassieri')}}">Cassieri</a>
                                <a class="nav-link {{($index == '7') ? 'active' : ''}}" href="{{url('/profili')}}">Profili</a>                                                                
                            </nav>
                        </div>
                        <a class="nav-link {{($index == '8') ? 'active' : ''}}" href="{{url('/sconti')}}">Sconti</a>
                        <a class="nav-link {{($index == '9') ? 'active' : ''}}" href="{{url('/pagamenti')}}">Forme di Pagamento</a>
                        <a class="nav-link {{($index == '10') ? 'active' : ''}}" href="{{url('/causali')}}">Versamenti / Prelievi</a>
                    </nav>
                </div>

                <a class="nav-link {{( ($index > '29') && ($index < '35') ) ? 'active' : 'collapsed'}}" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseFidelity" aria-expanded="false" aria-controls="collapseFidelity">
                    <div class="nav-link-icon"><i data-feather="credit-card"></i></div>
                    Tessere Fidelity
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{( ($index > '29') && ($index < '35') ) ? 'show' : ''}}" id="collapseFidelity" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion">                        
                        <a class="nav-link {{($index == '30') ? 'active' : ''}}" href="{{url('/lineafidelity')}}">Linea Fidelity</a>
                        <a class="nav-link {{($index == '31') ? 'active' : ''}}" href="{{url('/fidelitycard')}}">Fidelity Card</a>                        
                        <a class="nav-link {{($index == '32') ? 'active' : ''}}" href="{{url('/promozioni')}}">Raccolta Punti</a>
                    </nav>
                </div>

                <a class="nav-link {{( ($index > '20') && ($index < '29') ) ? 'active' : 'collapsed'}}" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseBarriera" aria-expanded="false" aria-controls="collapseBarriera">
                    <div class="nav-link-icon"><i data-feather="monitor"></i></div>
                    Barriera Casse
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{( ($index > '20') && ($index < '29') ) ? 'show' : ''}}" id="collapseBarriera" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion">                        
                        <a class="nav-link {{($index == '21') ? 'active' : ''}}" href="{{url('/depositi')}}">Depositi</a>
                        <a class="nav-link {{($index == '22') ? 'active' : ''}}" href="{{url('/casse')}}">Casse</a>                        
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