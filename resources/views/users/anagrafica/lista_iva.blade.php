<x-header :$title></x-header>
<body class="nav-fixed">
    <x-nav-bar></x-nav-bar>
    <div id="layoutSidenav">
        <x-side-nav :$index></x-side-nav>  
        <div id="layoutSidenav_content">          
            <x-ListaIva :$aliquote></x-ListaIva>
            <x-main.footer_mainpage></x-main.footer_mainpage>
        </div>    
    </div>       
    <x-footer></x-footer>
</body>
</html>