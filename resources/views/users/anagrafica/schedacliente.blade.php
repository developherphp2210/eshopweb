<x-header :$title></x-header>
<body class="nav-fixed">
    <x-NavBar></x-NavBar>
    <div id="layoutSidenav">
        <x-SideNav :$index></x-SideNav>    
        <div id="layoutSidenav_content">                  
        @switch($page)
            @case(1)                
                <x-SchedaCliente :$cliente></x-SchedaCliente>        
                @break        
            @case(2)
                <x-PartitarioCliente :$cliente></x-PartitarioCliente>
                @break
            @case(3)            
                <x-ListaFidelityClienti :$cliente></x-ListaFidelityClienti>
                @break
        @endswitch 
                <x-Footermainpage></x-Footermainpage>
        </div>
    </div>        
    <x-Footer></x-Footer>
</body>
</html>