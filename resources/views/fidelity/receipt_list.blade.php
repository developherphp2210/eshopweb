<x-header :title="$title"></x-header>
<body class="nav-fixed">
    <x-nav-bar-fidelity :user="$user" :cards="$cards"></x-nav-bar-fidelity>
    <div id="layoutSidenav">
        <x-side-nav-fidelity :us="$user"></x-side-nav-fidelity> 
        <div id="layoutSidenav_content">       
            <x-fidelity.receipt-list :user="$user" :transactions="$transactions"></x-fidelity.receipt-list>
            <x-main.footer_mainpage></x-main.footer_mainpage>   
        </div>    
    </div>        
</body>
<x-footer></x-footer>
</html>