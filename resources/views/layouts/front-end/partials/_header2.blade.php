<style>
    .nav-mobiles {
        position: fixed !important;
        top: 0;
        height: 55px;
        left: 0;
        right: 0;
        z-index: 9;
    }
    .bg-img2{
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
    }
    .bg-img2 img {
        width: 100%;
        height: 100%;
    }
</style>
<nav class="navbar p-2 nav-mobiles navbar-horizontal navbar-expand-md navbar-dark">
    <div class="bg-img2">
        <img src="{{ asset('assets/front-end/img/bg-nav.jpg') }}" alt="">
    </div>
    <div class="container-fluid mx-auto justify-content-center">
        <div class="row w-100">
            <div class="col-12 d-flex justify-content-center page-title text-center">
                {{-- @if (session()->get('page-title') == "home")
                <div class="row">
                    <div class="col-12 text-center title-div d-flex flex-column">
                        <span class="title-name">Praktek Mandiri</span>
                        <span class="title-name">Bidan Ratna Dewi</span>
                    </div>
                </div>
                @else --}}
                <h2>
                    {{ session()->get('page-title') }}
                </h2>
                {{-- @endif --}}
            </div>
        </div>
    </div>
</nav>
