<x-header :$title></x-header>
<body class="nav-fixed">
    <x-NavBar></x-NavBar>
    <div id="layoutSidenav">
        <x-SideNav :$index></x-SideNav>  
        <div id="layoutSidenav_content">         
        @switch($page)
            @case(1)                
                <x-scheda-articolo :$listaArticolo></x-scheda-articolo>        
                @break        
            @case(2)
                <x-partitario-articolo :$listaArticolo></x-partitario-articolo>        
                @break                    
        @endswitch 
        <x-Footermainpage></x-Footermainpage>
        </div>
    </div>
    <x-Footer></x-Footer>
</body>
</html>