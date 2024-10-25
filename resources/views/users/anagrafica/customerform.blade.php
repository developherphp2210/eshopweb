<x-header :$title></x-header>
<body class="nav-fixed">
    <x-NavBar></x-NavBar>
    <div id="layoutSidenav">
        <x-SideNav :us="$user"></x-SideNav>    
        <div id="layoutSidenav_content">                     
        @switch($page)
            @case(1)                
                <x-customer-form :cliente='$customer'></x-customer-form>        
                @break        
            @case(2)
                <x-customer-ledger :cliente='$customer' :ledger='$ledgers'></x-customer-ledger>
                @break                    
        @endswitch 
                <x-Footermainpage></x-Footermainpage>
        </div>
    </div>        
    <x-Footer></x-Footer>
</body>
</html>