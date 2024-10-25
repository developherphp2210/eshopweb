<x-header :title="$title"></x-header>
<body class="nav-fixed">
    <x-nav-bar-admin ></x-nav-bar-admin>
    <div id="layoutSidenav">
        <x-side-nav-admin :us="$user"></x-side-nav-admin>  
        <div id="layoutSidenav_content">
        @switch($page)
            @case(1)
                <x-account.page1 :user="$user" :notification="$notification"></x-account.page1>
                @break
        
            @case(2)
                <x-account.page2 :user="$user" :notification="$notification"></x-account.page2>
                @break                               
        @endswitch 
        <x-Footermainpage></x-Footermainpage>
        </div>
    </div>    
    <x-Footer></x-Footer>
</body>
</html>