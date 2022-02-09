<footer class="">
    <div class="container">
        <div class="row">
            <div class="col-12 p-0">
                <div class="navbar p-0">
                    <div class="navbar-nav mx-auto d-flex flex-row justify-content-between w-100 px-4">
                        <li class="nav-item {{Request::is('pasien')?'active':''}}">
                            <a class="nav-link nav-footer nav-link-icon d-flex flex-column align-items-center"
                                href="{{ route('home') }}">
                                <i class="fas fa-home mb-1"></i>
                                <span class="nav-link-inner--text">{{ __('Beranda') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{Request::is('checkup')?'active':''}}">
                            <a class="nav-link nav-footer nav-link-icon d-flex flex-column align-items-center"
                                href="{{ route('checkup') }}">
                                <i class="fas fa-briefcase-medical mb-1"></i>
                                <span class="nav-link-inner--text">{{ __('Pemeriksaan') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{Request::is('profile/view')?'active':''}}">
                            <a class="nav-link nav-footer nav-link-icon d-flex flex-column align-items-center"
                                href="{{ route('profile.view') }}">
                                <i class="fas fa-user mb-1"></i>
                                <span class="nav-link-inner--text">{{ __('Profil') }}</span>
                            </a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
