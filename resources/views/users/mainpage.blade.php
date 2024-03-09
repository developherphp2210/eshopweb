<x-header :title="$title"></x-header>
<body class="nav-fixed">
    <x-nav-bar :us="$user"></x-nav-bar>
    <div id="layoutSidenav">
        <x-SideNav :user="$user" :index="$index"></x-SideNav> 
        <div id="layoutSidenav_content">           
            <x-main-page-dashboard :user="$user" :total="$total"></x-main-page-dashboard>
            <x-main.footer_mainpage></x-main.footer_mainpage>
        </div>    
    </div>
    <x-footer></x-footer>        
</body>
</html>