<x-headerFidelity :$title></x-headerFidelity>
<body class="nav-fixed">
    <x-NavBarFidelity></x-NavBarFidelity>
    <div id="layoutSidenav">
        <x-SideNavFidelity :$index></x-SideNavFidelity> 
        <div id="layoutSidenav_content">           
            <x-mainpage-fidelity></x-mainpage-fidelity>
            <x-FootermainpageFidelity></x-FootermainpageFidelity>
        </div>    
    </div>
    <x-FooterFidelity></x-FooterFidelity>
</body>
</html>