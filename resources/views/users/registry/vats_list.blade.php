<x-header :title="$title"></x-header>
<body class="nav-fixed">
    <x-nav-bar :us="$user"></x-nav-bar>
    <div id="layoutSidenav">
        <x-side-nav :us="$user"></x-side-nav>  
        <div id="layoutSidenav_content">          
            <x-vats-page :iva="$vats"></x-vats-page>
            <x-main.footer_mainpage></x-main.footer_mainpage>
        </div>    
    </div>       
</body>
<x-footer></x-footer>
</html>