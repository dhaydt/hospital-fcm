<nav class="navbar p-2 nav-mobile navbar-horizontal navbar-expand-md navbar-dark">
    <div class="bg-nav">
        <img src="{{ asset('assets/front-end/img/bg-nav.jpg') }}" alt="">
    </div>
    <div class="container-fluid mx-auto justify-content-center">
        <div class="row w-100">
            <div class="col-12 d-flex justify-content-center page-title text-center">
                @if (session()->get('page-title') == "home")
                <div class="row w-100">
                    <div class="col-12 text-end px-0">
                        <span class="title-welcome d-block">Selamat datang di,</span>
                        <span class="title-app">Bidan Ratna Dewi</span>
                    </div>
                    <div class="col-12 text-start px-0">
                        <span class="title-welcom d-block">Hai,</span>
                        <span class="title-name">{{ auth('customer')->user()->name }}</span>
                    </div>
                </div>
                @else
                <h2>
                    {{ session()->get('page-title') }}
                </h2>
                @endif
            </div>
        </div>
    </div>
</nav>
