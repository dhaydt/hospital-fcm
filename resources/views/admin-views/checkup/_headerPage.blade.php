<div class="header bg-primary pb-8 pt-3 pt-md-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-3 col-4 d-flex">
                    {{-- <h6 class="h2 text-white d-inline-block mb-0">Tables</h6> --}}
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-2">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Checkup</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-9 col-5 text-right d-flex">
                    <div class="d-flex justify-content-between">
                        <form action="{{ url()->current() }}" id="sort-range" method="GET" class="d-flex mb-0">
                            {{-- @csrf --}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"  id="basic-addon1">Start date</span>
                                </div>
                                <input type="date" value="{{ $start }}" class="form-control" name="start-date">
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2">End date</span>
                                </div>
                                <input type="date" autocomplete="off" value="{{ $end }}" name="end-date" required class="form-control dated" id="end-date" aria-describedby="basic-addon2">
                            </div>
                            <button class="btn btn-primary btn-sm mx-3" type="submit">Filter</button>
                        </form>
                    </div>
                    <a href="{{ route('admin.checkup.list') }}" class="btn-clear btn btn-sm btn-danger p-2">Clear Filter</a>
                    <button type="button" class="btn btn-sm btn-neutral p-2" data-toggle="modal"
                        data-target="#modal-form">Add Checkup</button>
                    {{-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
                    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                        aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">

                                <div class="modal-body p-0">
                                    <div class="card bg-secondary border-0 mb-0">
                                        <div class="card-body px-lg-5 py-lg-5">
                                            <div class="text-center text-muted mb-4">
                                                <h4 class="uppercase">Register Checkup</h4>
                                            </div>
                                            <form class="js-validate" role="form" method="POST" action="{{route('admin.checkup.store')}}">
                                                @csrf
                                                <div class="form-group mb-3 pasien-form">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text w-100 bg-grey text-white capitalize">Pasien</span>
                                                        </div>
                                                        <select id="select-beast" class="form-select text-left" name="pasien_id" placeholder="Pilih pasien" autocomplete="off">
                                                            <option value="">Select a person...</option>
                                                            @foreach ($pasien as $p)
                                                            <option value="{{ $p['id'] }}">{{ $p['name'] }} <span class="text-red">({{ $p['phone'] }})</span></option>
                                                            @endforeach
                                                        </select>
                                                        {{-- <input class="pl-2 form-control" name="name" placeholder="Full Name" type="text"> --}}
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 pasien-form text-left ml-1">
                                                    <label class="form-label">Jenis layanan</label>
                                                    <?php $no = 1?>
                                                    @foreach ($cat as $c)
                                                    <div class="form-check" style="margin-left: 15px">
                                                        <input class="form-check-input" name="chat[]" type="checkbox" value="{{ $c->id }}" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            {{ $c->name }}
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                {{-- <div class="form-group mb-3 pasien-form">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text w-100 bg-grey text-white">Birth Date</span>
                                                        </div>
                                                        <input class="pl-2 form-control" name="birthdate" placeholder="Birthdate" type="date">
                                                    </div>
                                                </div> --}}

                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary my-4">Register Checkup</button>
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
@push('script')
    <script>
        new TomSelect("#select-beast",{
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    </script>
@endpush
