<x-header :$title></x-header>
<body class="nav-fixed">
    <x-nav-bar ></x-nav-bar>
    <div id="layoutSidenav">
        <x-side-nav :$index></x-side-nav>  
        <div id="layoutSidenav_content">         
        @switch($page)
            @case(1)                
                <x-scheda-articolo :$listaArticolo></x-scheda-articolo>        
                @break        
            @case(2)
            <x-partitario-articolo :$listaArticolo></x-partitario-articolo>        
                @break                    
        @endswitch 
            <x-main.footer_mainpage></x-main.footer_mainpage>
        </div>
    </div>
    <x-footer></x-footer>
</body>
</html>