<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- PWA -->
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('assets/front-end/img/logo.jpeg') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <title>@yield('title')</title>
    <!-- Favicon -->
    <link href="{{ asset('storage/company/'.$web_config['fav_icon']->value) }}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"><!-- Extra details for Live View on GitHub Pages -->

    <!-- Icons -->
    <link href="{{ asset('assets') }}/front-end/css/mainstyledd.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/back-end/css/toastr.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Pull refresh plugin -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/front-end/pull/mk-pullfresh.css') }}"> --}}
</head>

<body class="mb-0">
    {{-- @auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @include('layouts.navbars.sidebar')
    @endauth --}}

    <div class="main-content" id="main-content">
        <div class="row main-row mx-auto">
            <div class="col-12 p-0">
                @if (!Route::is('home2') && !Route::is('content2') && !Route::is('home'))
                @include('layouts.front-end.partials._header2')
                @endif
                @if (Route::is('home'))
                @include('layouts.front-end.partials._header')
                <div class="mt-content"></div>
                @endif
                <div class="div-content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @if (!Route::is('home2') && !Route::is('content2'))
    @include('layouts.front-end.partials._footer')
    @endif

    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{asset('assets/back-end')}}/js/vendor.min.js"></script>
    <script src="{{asset('assets/back-end')}}/js/theme.min.js"></script>
    <script src="{{asset('assets/back-end')}}/js/sweet_alert.js"></script>
    <script src="{{asset('assets/back-end')}}/js/toastr.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    {{-- <script src="{{ asset('assets/front-end/pull/mk-pullfresh.js') }}"></script> --}}
    {!! Toastr::message() !!}

    @if ($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
        </script>
    @endif
    @stack('js')
        {{-- <script>
            $('#main-content').mkPullFresh({
            indicatorHtml:'<div class="mkpf-envelop"><div class="mkpf-indicator-wrapper" style="z-index:11; margin-top: 200px;"><div class="mkpf-indicator"><div class="mkpf-icon-wrapper"><i class="mkpf-arrow-down"></i></div><i class="mkpf-spinner"></i></div></div></div>'
            });
        </script> --}}
    <!-- Argon JS -->
    <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
    @stack('script')
    @stack('script_2')
    <script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>
</body>

</html>
