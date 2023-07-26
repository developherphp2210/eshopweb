<x-header :title="$title"></x-header>
<body class="nav-fixed">
    <x-nav-bar-fidelity :user="$user" :cards="$cards"></x-nav-bar-fidelity>
    <div id="layoutSidenav">
        <x-side-nav-fidelity :user="$user" :cards="$cards"></x-side-nav-fidelity> 
        <div id="layoutSidenav_content">       
            <x-fidelity.receipt :receipt="$receipt"></x-fidelity.receipt>
            <x-main.footer_mainpage></x-main.footer_mainpage>   
        </div>    
    </div>        
    <x-footer></x-footer>
</body>
</html>