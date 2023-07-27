<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
@if ( env('APP_DEBUG') === true)
    @vite(['resources/js/scripts.js'])
    @vite(['resources/js/chart.js'])
@else
<script type="module" src="/build/assets/js/chart.js"></script>
<script src="/build/assets/js/scripts.js"></script>
@endif

    