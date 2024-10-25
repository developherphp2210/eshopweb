@if(session()->has('result'))
<div class="toast-container position-fixed  bottom-0 end-0 p-3 top-0 end-0">
    <div id="liveToast" class="toast {{(session('result')['error'] == 'true') ? 'text-bg-danger' : 'text-bg-success'}}" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header {{(session('result')['error'] == 'true') ? 'text-bg-danger' : 'text-bg-success'}}">
            <!-- <img src="..." class="rounded me-2" alt="..."> -->
            <strong class="me-auto">{{session('result')['title']}}</strong>
            <!-- <small>11 mins ago</small> -->
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{session('result')['message']}}
        </div>
    </div>
</div>
@endif
<footer class="footer-admin mt-auto footer-light">
    <div class="container-xl px-4">
        <div class="row">
            <div class="col-md-6 small">Copyright &copy; Your Website 2021</div>
            <div class="col-md-6 text-md-end small">
                <a href="#!">Privacy Policy</a>
                &middot;
                <a href="#!">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>