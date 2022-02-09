<div class="header bg-primary pb-8 pt-3 pt-md-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7 d-flex">
                    {{-- <h6 class="h2 text-white d-inline-block mb-0">Tables</h6> --}}
                    <nav aria-label="breadcrumb " class="d-none d-md-inline-block ml-md-2">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="javascript:">User Section</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pasien</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right d-flex">
                    <form action="{{ url()->current() }}" method="get" class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                        @csrf
                        <div class="form-group mb-0">
                            <div class="input-group input-group-alternative">
                                <input class="form-control" name="search" placeholder="Search" value="{{ $search }}" type="text">
                                <button type="submit" class="search-btn input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </button>
                            </div>
                        </div>
                    </form>
                    <button type="button" class="btn btn-sm btn-neutral p-2" data-toggle="modal"
                        data-target="#modal-form">Add Pasien</button>

                    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                        aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">

                                <div class="modal-body p-0">
                                    <div class="card bg-secondary border-0 mb-0">
                                        <div class="card-body px-lg-5 py-lg-5">
                                            <div class="text-center text-muted mb-4">
                                                <h4 class="uppercase">Add Pasien</h4>
                                            </div>
                                            <form class="js-validate" role="form" method="POST" action="{{route('admin.addCustomer')}}">
                                                @csrf
                                                <div class="form-group mb-3 pasien-form">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text w-100 bg-grey text-white capitalize">Full name</span>
                                                        </div>
                                                        <input class="pl-2 form-control" name="name" placeholder="Full Name" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 pasien-form">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text w-100 bg-grey text-white">Phone</span>
                                                        </div>
                                                        <input class="pl-2 form-control" name="phone" placeholder="Phone" type="number">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 pasien-form">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text w-100 bg-grey text-white">Birth Date</span>
                                                        </div>
                                                        <input class="pl-2 form-control" name="birthdate" placeholder="Birthdate" type="date">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 pasien-form">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text w-100 bg-grey text-white">Address</span>
                                                        </div>
                                                        <textarea class="pl-2 form-control" name="address" placeholder="Address"></textarea>
                                                    </div>
                                                </div>

                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary my-4">Add Pasien</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
