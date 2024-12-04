<x-header :title="$title"></x-header>
<body class="nav-fixed">
    <x-nav-bar></x-nav-bar>
    <div id="layoutSidenav">
        <x-side-nav :$index></x-side-nav> 
        <div id="layoutSidenav_content"> 
        @switch($page)
            @case(1)
                <x-page1></x-page1>
                @break
        
            @case(2)
                <x-page2></x-page2>
                @break           
        @endswitch  
        <x-Footermainpage></x-Footermainpage>
        </div>        
    </div>    
    <x-footer></x-footer>
</body>
</html>