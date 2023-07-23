<x-header :title="$title"></x-header>
<body class="nav-fixed">
    <x-nav-bar-admin :us="$user"></x-nav-bar-admin>
    <div id="layoutSidenav">
        <x-side-nav-admin :us="$user"></x-side-nav-admi>
        <div id="layoutSidenav_content">       
            <x-main.footer_mainpage></x-main.footer_mainpage>    
        </div>    
    </div>        
</body>
<x-footer></x-footer>
</html>