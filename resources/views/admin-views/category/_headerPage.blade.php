<div class="header bg-primary pb-8 pt-3 pt-md-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7 d-flex">
                    {{-- <h6 class="h2 text-white d-inline-block mb-0">Tables</h6> --}}
                    <nav aria-label="breadcrumb " class="d-none d-md-inline-block ml-md-2">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                        class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="javascript:">Service Section</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Category</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right d-flex justify-content-end">
                    {{-- <form action="{{ url()->current() }}" method="get"
                        class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                        @csrf
                        <div class="form-group mb-0">
                            <div class="input-group input-group-alternative">
                                <input class="form-control" name="search" placeholder="Search" value="{{ $search }}"
                                    type="text">
                                <button type="submit" class="search-btn input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </button>
                            </div>
                        </div>
                    </form> --}}
                    <button type="button" class="btn btn-sm btn-neutral p-2" data-toggle="modal"
                        data-target="#modal-form">Add Category</button>

                    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                        aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">

                                <div class="modal-body p-0">
                                    <div class="card bg-secondary border-0 mb-0">
                                        <div class="card-body px-lg-5 py-lg-5">
                                            <div class="text-center text-muted mb-4">
                                                <h4 class="uppercase">Add Category</h4>
                                            </div>
                                            <form class="js-validate" role="form" method="POST"
                                                action="{{route('admin.category.store')}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group mb-3 pasien-form">
                                                    <div class="input-group input-group-merge input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text w-100 bg-grey text-white capitalize">Name</span>
                                                        </div>
                                                        <input class="pl-2 form-control" name="name"
                                                            placeholder="Categories name" type="text">
                                                    </div>
                                                </div>
                                                {{-- <input type="file" name="images"> --}}
                                                <div class="mb-3 d-flex">
                                                    <div class="col-md-6 pl-0">
                                                        <div class="custom-file" style="text-align: left">
                                                            <input type="file" name="image" id="fbimageFileUploader"
                                                                class="custom-file-input"
                                                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                                            <label class="custom-file-label"
                                                                for="fbimageFileUploader">Change logo</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <center>
                                                            <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px; max-width:100%;"
                                                                id="fbImageviewers"
                                                                src="{{asset('assets\back-end\img\400x400\img2.jpg')}}"
                                                                alt="banner image" />
                                                        </center>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary my-4">Save</button>
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
    $("#fbimageFileUploader").change(function () {
            fbimagereadURL(this);
        });

        function fbimagereadURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#fbImageviewers').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

</script>
@endpush
