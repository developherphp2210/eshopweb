<x-header :title="$title"></x-header>
<body class="nav-fixed">
    <x-nav-bar :us="$user"></x-nav-bar>
    <div id="layoutSidenav">
        <x-side-nav :us="$user"></x-side-nav> 
        <div id="layoutSidenav_content"> 
        @switch($page)
            @case(1)
                <x-account.page1 :user="$user" :notification="$notification"></x-account.page1>
                @break
        
            @case(2)
                <x-account.page2 :user="$user" :notification="$notification"></x-account.page2>
                @break           
        @endswitch  
                <x-main.footer_mainpage></x-main.footer_mainpage>
        </div>        
    </div>    
</body>
<x-footer></x-footer>
</html>