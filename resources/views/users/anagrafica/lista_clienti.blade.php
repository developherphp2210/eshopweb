<x-header :title="$title"></x-header>
<body class="nav-fixed">
    <x-nav-bar></x-nav-bar>
    <div id="layoutSidenav">
        <x-SideNav :$index></x-SideNav>    
        <div id="layoutSidenav_content">       
            <x-ListaClienti :$clienti></x-ListaClienti>
            <x-main.footer_mainpage></x-main.footer_mainpage>
        </div>    
    </div>        
    <x-footer></x-footer>
</body>
</html>