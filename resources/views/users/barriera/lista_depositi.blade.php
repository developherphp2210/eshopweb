<x-header :title="$title"></x-header>
<body class="nav-fixed">
    <x-nav-bar></x-nav-bar>
    <div id="layoutSidenav">
        <x-side-nav :$index></x-side-nav>  
        <div id="layoutSidenav_content">         
            <x-ListaDepositi :$listadepositi></x-ListaDepositi>
            <x-main.footer_mainpage></x-main.footer_mainpage>
        </div>    
    </div>        
    <x-footer></x-footer>
</body>
</html>