{{-- @if (Session::has('info'))
    <div class="box-body pad res-tb-block">
        <div class="button-box">
            <button onclick="tst1" class="tst1 btn btn-info btn-block mb-15">Info Message</button>
        </div>
    </div>
@endif --}}

@if (Session::has('success'))
    <div class="col-12">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-12">
                        <div id="alerttopright"
                            class="myadmin-alert myadmin-alert-img alert-success myadmin-alert-top-right"> <img
                                src="../images/avatar.png" class="img" alt="img"><a href="#" class="closed">&times;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if (Session::has('fasd'))
    <div class="box-body pad res-tb-block">
        <div class="button-box">
            <button class="tst3 btn btn-success btn-block mb-15">Success
                Message</button>
        </div>
    </div>
@endif

@if (Session::has('warning'))
    <div class="box-body pad res-tb-block">
        <div class="button-box">
            <button class="tst2 btn btn-warning btn-block mb-15">Warning
                Message</button>
        </div>
    </div>
@endif

@if (Session::has('error'))
    <div class="box-body pad res-tb-block">
        <div class="button-box">
            <button class="tst4 btn btn-danger btn-block mb-15">Danger Message</button>
        </div>
    </div>
@endif
