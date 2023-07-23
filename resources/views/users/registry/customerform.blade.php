<x-header :title="$title"></x-header>
<body class="nav-fixed">
    <x-nav-bar :us="$user"></x-nav-bar>
    <div id="layoutSidenav">
        <x-side-nav :us="$user"></x-side-nav>    
        <div id="layoutSidenav_content">                     
        @switch($page)
            @case(1)                
                <x-customer-form :cliente='$customer'></x-customer-form>        
                @break        
            @case(2)
                <x-customer-ledger :cliente='$customer' :ledger='$ledgers'></x-customer-ledger>
                @break                    
        @endswitch 
                <x-main.footer_mainpage></x-main.footer_mainpage>
        </div>
    </div>        
</body>
<x-footer></x-footer>
</html>