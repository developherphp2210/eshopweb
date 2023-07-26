<x-header :title="$title"></x-header>
<body class="nav-fixed">
    <x-nav-bar :us="$user"></x-nav-bar>
    <div id="layoutSidenav">
        <x-side-nav :us="$user"></x-side-nav> 
        <div id="layoutSidenav_content">                  
        @switch($page)
            @case(1)                
                <x-article-form :articolo='$articles' :codean='$codeans'></x-article-form>        
                @break        
            @case(2)
                <x-article-ledger :articolo='$articles' :ledger='$ledgers'></x-article-ledger>
                @break                    
        @endswitch 
        <x-main.footer_mainpage></x-main.footer_mainpage>
        </div>
    </div>        
    <x-footer></x-footer>
</body>
</html>