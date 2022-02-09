@extends('layouts.backend.app')
@section('title', 'Kategori')
@section('content')
@include('admin-views.category._headerPage')
<style>
    .viewUser {
        font-size: 22px;
        color: #5e72e4;
    }

    .card-footer {
        /* background-color: grey; */
    }

    .card-footer .row.justify-content-center .col-sm-auto .d-flex nav .flex {
        display: none;
    }

    .card-footer>div>div>div>nav>div.hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between>div:nth-child(1)>p {
        display: none;
    }

    .card-footer>div>div>div>nav>div.hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between>div:nth-child(2)>span {
        display: flex;
    }

    .card-footer>div>div>div>nav>div.hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between>div:nth-child(2)>span span:first-child span svg {
        margin-right: 15px;
    }

    .card-footer>div>div>div>nav>div.hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between>div:nth-child(2)>span>a:first-child svg {}
</style>
<div class="container-fluid mt--8">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                {{-- <div class="card-header border-0">
                    <h3 class="mb-0">Admin table</h3>
                </div> --}}
                <!-- Light table -->
                {{-- {{ var_dump($admin) }} --}}
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col" class="sort" data-sort="no">NO</th>
                                <th scope="col" class="sort" data-sort="name">Name</th>
                                <th scope="col" class="sort" data-sort="image">image</th>
                                <th scope="col" class="sort" data-sort="completion">Action</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @if (count($admin) > 0)
                            <?php $no = 1;?>
                            @foreach ($admin as $ad)
                            {{-- Modal --}}
                            {{-- {{ dd($ad) }} --}}
                            <div class="modal fade" id="staticBackdrop-{{ $ad['id'] }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog pasien-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title capitalize" id="staticBackdropLabel">Ubah kategori {{
                                                $ad['name'] }}</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.category.update') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="{{ $ad['id'] }}">
                                            <div class="form-group mb-3 pasien-form">
                                                <div class="input-group input-group-merge input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span
                                                            class="input-group-text w-100 bg-grey text-white">Nama</span>
                                                    </div>
                                                    <input class="pl-2 form-control" id="named{{ $ad['id'] }}" name="name"
                                                        value="{{ $ad['name'] }}"></input>
                                                </div>
                                            </div>
                                            <div class="mb-3 d-flex">
                                                <div class="col-md-6 pl-0">
                                                    <div class="custom-file" style="text-align: left">
                                                        <input type="file" name="image" id="editCat"
                                                            class="custom-file-input"
                                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                                        <label class="custom-file-label"
                                                            for="fbimageFileUploaderss">Change Image</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <center>
                                                        <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px; max-width:100%;"
                                                            id="editCatView"
                                                            src="{{ asset('storage/category/'.$ad->image) }}"
                                                            alt="banner image" />
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Keluar</button>
                                            <button type="submit" class="btn btn-primary"
                                               ">Update</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal --}}
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="budget text-center capitalize">
                                    {{ $ad['name'] }}
                                </td>
                                <td class="text-center">
                                    <div class="avatar-group">
                                        <a href="javascript:" class="avatar avatar-md rounded-circle bg-light" data-toggle="tooltip"
                                            data-original-title="{{ $ad['name'] }}">
                                            <img alt="Image" src="{{ asset('storage/category/'.$ad['image']) }}">
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center action-col">
                                        <a href="javascript:" class="viewUser p-1" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop-{{ $ad->id }}">
                                            <i class="far fa-edit text-success"></i>
                                        </a>
                                        {{-- <a href="javascript:" class="viewUser btn p-1" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop-{{ $ad->id }}">
                                            <i class="far fa-edit text-success"></i>
                                        </a> --}}
                                        {{-- <a href="javascript:" class="viewUser">
                                            <i class="far fa-edit text-success"></i>
                                        </a> --}}
                                        <a href="{{ route('admin.category.delete', ['id' => $ad['id']]) }}"
                                            class="viewUser p-1">
                                            <i class="fas fa-trash text-danger"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- Card footer -->
                @if (count($admin) > 0)
                <div class="card-footer">
                    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                        <div class="col-sm-auto">
                            <div class="d-flex justify-content-center justify-content-sm-end">
                                <!-- Pagination -->
                                {!! $admin->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center p-4">
                    <img class="mb-3" src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg"
                        alt="Image Description" style="width: 7rem;">
                    <p class="mb-0">Tidak ada data kategori</p>
                </div>

                @endif
            </div>
        </div>
    </div>
    @endsection
    <script>
        function update(val){
        var id = val
        var name = $('#named' + val).val()
        // console.log(id, back)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('admin.editCustomer')}}",
            method: 'POST',
            data: {id: id, name: name, phone: phone, address: address, birth: birth},
            success: function () {
                toastr.success('Data pasien berhasil diubah');
                location.reload();
            }
        });
    }
    </script>
    @push('script')
    <script>
        $("#editCat").change(function () {
            fbimagereadURL(this);
        });

        function fbimagereadURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#editCatView').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
    @endpush
