<x-headerFidelity :title="$title"></x-headerFidelity>
<body class="nav-fixed">
    <x-nav-barFidelity></x-nav-barFidelity>
    <div id="layoutSidenav">
        <x-side-navFidelity :$index></x-side-navFidelity>
        <div id="layoutSidenav_content">  
        @switch($page)
            @case(1)
                <x-page1></x-page1>
                @break
        
            @case(2)
                <x-page2></x-page2>
                @break
            @case(3)           
                <x-fidelitylist></x-fidelitylist>
                @break                         
        @endswitch  
        <x-FootermainpageFidelity></x-FootermainpageFidelity>
        </div>           
    </div>    
    <x-footerFidelity></x-footerFidelity>
</body>
</html>
