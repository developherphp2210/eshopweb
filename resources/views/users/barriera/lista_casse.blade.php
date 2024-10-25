<x-header :title="$title"></x-header>
<body class="nav-fixed">
    <x-nav-bar></x-nav-bar>
    <div id="layoutSidenav">
        <x-side-nav :$index></x-side-nav>  
        <div id="layoutSidenav_content">         
            <x-ListaCasse :$listacasse></x-ListaCasse>
            <x-Footermainpage></x-Footermainpage>
        </div>    
    </div>        
    <x-Footer></x-Footer>
</body>
</html>