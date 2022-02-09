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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <!-- Extra details for Live View on GitHub Pages -->

    <!-- Icons -->
    <link href="{{ asset('assets') }}/front-end/css/loginStyle.css" rel="stylesheet">
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

</head>

<body class="{{ $class ?? '' }}">
    {{-- @auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @include('layouts.navbars.sidebar')
    @endauth --}}

    <div class="main-content text-center">
        <div class="row main-row mx-auto">
            <div class="col-12 px-0">
                <img class="clipt-path" src="{{ asset('assets/front-end/img/bg-top.jpeg') }}" alt="">
                <div class="login-card border-0">
                <div class="row px-4">
                    <div class="card-header head-login bg-transparent">
                        <div class="avatar avatar-login">
                            <img src="{{ asset('assets/front-end/img').'/avatar.jpeg' }}" alt="">
                        </div>
                    </div>
                    <div class="logo-session mt-4">
                        <div class="logo-avatar avatar">
                            <img src="{{ asset('storage/company').'/'.$web_config['web_logo']->value }}" alt="">
                        </div>
                    </div>
                    <div class="card-body px-lg-5">
                        <div class="title-login mb-3">Silahkan login</div>
                        <form class="js-validate" role="form" method="POST" action="{{ route('customersLogin_submit') }}">
                            @csrf

                            <div class="js-form-message form-group{{ $errors->has('phone') ? ' has-danger' : '' }} mb-4">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white"><i class="fas fa-phone login-icon"></i></span>
                                    </div>
                                    <input class="pl-2 form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                        placeholder="Nomor Handphone" type="number" name="phone"
                                        value="{{ old('phone') }}" id="signinSrPhone" required
                                        data-msg="Harap isi no Handphone.">
                                </div>
                                @if ($errors->has('phone'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="js-form-message form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white"><i class="ni ni-lock-circle-open login-icon"></i></span>
                                    </div>
                                    <input id="signupSrPassword"
                                        class="pl-2 js-toggle-password form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" placeholder="{{ __('Password') }}" type="password" required data-msg="Harap isi no password."
                                        data-hs-toggle-password-options='{
                                        "target": "#changePassTarget",
                                        "defaultClass": "fa-eye-slash",
                                        "showClass": "fa-eye",
                                        "classChangeTarget": "#changePassIcon"
                                    }'>
                                    <div id="changePassTarget" class="input-group-append">
                                        <a class="input-group-text bg-white" href="javascript:">
                                            <i id="changePassIcon" class="fas fa-eye-slash login-icon"></i>
                                        </a>
                                    </div>
                                </div>
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="row text-left">
                                <div class="col-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                        <label class="form-check-label label-forgot" for="flexSwitchCheckChecked">Simpan Password</label>
                                        </div>
                                </div>
                                    {{-- <div class="col-6 text-end">
                                        <div class="forgot-password">
                                            <a href="" class="label-forgot">Lupa Password ?</a>
                                        </div>
                                    </div> --}}
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="col-12 text-center px-0">
                                    <button type="submit" class="btn btn-login btn-primary w-100 btn-login my-4">LOGIN</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <img class="clipt-path2" src="{{ asset('assets/front-end/img/bg-bot.jpeg') }}" alt="">
        </div>
        </div>
    </div>

    {{-- @guest()
    @if(!Route::is('customersLogin'))
    @include('layouts.front-end.partials._footer')
    @endif
    @endguest --}}

    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{asset('assets/back-end')}}/js/vendor.min.js"></script>
    <script src="{{asset('assets/back-end')}}/js/theme.min.js"></script>
    <script src="{{asset('assets/back-end')}}/js/sweet_alert.js"></script>
    <script src="{{asset('assets/back-end')}}/js/toastr.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
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

    <!-- Argon JS -->
    <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
    <script>
         $(document).on('ready', function () {
        // INITIALIZATION OF SHOW PASSWORD
        // =======================================================
        $('.js-toggle-password').each(function () {
            new HSTogglePassword(this).init()
        });

        // INITIALIZATION OF FORM VALIDATION
        // =======================================================
        $('.js-validate').each(function () {
            $.HSCore.components.HSValidation.init($(this));
        });
    });
    </script>

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
