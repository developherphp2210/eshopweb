<x-header :title="$title"></x-header>
<body class="nav-fixed">
    <x-nav-bar :us="$user"></x-nav-bar>
    <div id="layoutSidenav">
        <x-side-nav :us="$user"></x-side-nav>  
        <div id="layoutSidenav_content">         
            <x-departments-page :reparti="$departments"></x-departments-page>
            <x-main.footer_mainpage></x-main.footer_mainpage>
        </div>    
    </div>        
    <x-footer></x-footer>
</body>
</html>