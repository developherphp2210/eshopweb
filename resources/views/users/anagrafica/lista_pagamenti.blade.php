<x-header :$title></x-header>
<body class="nav-fixed">
    <x-NavBar></x-NavBar>
    <div id="layoutSidenav">
        <x-SideNav :$index></x-SideNav>  
        <div id="layoutSidenav_content">         
            <x-ListaPagamenti :$listapagamenti></x-ListaPagamenti>
            <x-Footermainpage></x-Footermainpage>
        </div>    
    </div>        
    <x-Footer></x-Footer>
</body>
</html>