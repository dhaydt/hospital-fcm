@extends('layouts.backend.app')
@section('title', 'Pasien List')
@section('content')
@include('admin-views.customer._headerPage')
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
                                <th scope="col" class="sort" data-sort="name">NO</th>
                                <th scope="col" class="sort" data-sort="name">ID</th>
                                <th scope="col" class="sort" data-sort="budget">Name</th>
                                <th scope="col" class="sort" data-sort="status">Phone</th>
                                <th scope="col" class="sort" data-sort="status">Address</th>
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
                                            <h4 class="modal-title capitalize" id="staticBackdropLabel">Ubah data pasien {{
                                                $ad['name'] }}</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
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
                                            <div class="form-group mb-3 pasien-form">
                                                <div class="input-group input-group-merge input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span
                                                            class="input-group-text w-100 bg-grey text-white">Telepon</span>
                                                    </div>
                                                    <input class="pl-2 form-control" id="phoned{{ $ad['id'] }}" name="phone" type="number"
                                                        value="{{ $ad['phone'] }}"></input>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3 pasien-form">
                                                <div class="input-group input-group-merge input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span
                                                            class="input-group-text w-100 bg-grey text-white">Alamat</span>
                                                    </div>
                                                    <textarea class="pl-2 form-control" id="address{{ $ad['id'] }}"
                                                        name="address">{{ $ad['address'] }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3 pasien-form">
                                                <div class="input-group input-group-merge input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text w-100 bg-grey text-white">Lahir</span>
                                                    </div>
                                                    <input class="pl-2 form-control" id="birth{{ $ad['id'] }}" name="birth_date" type="date"
                                                        value="{{ $ad['birth_date'] }}"></input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Keluar</button>
                                            <button type="button" class="btn btn-primary"
                                                onclick="update({{ $ad['id'] }})">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal --}}
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body text-center">
                                            <span class="name mb-0 text-sm">{{ $ad['id'] }}</span>
                                        </div>
                                    </div>
                                </th>
                                <td class="budget text-center capitalize">
                                    {{ $ad['name'] }}
                                </td>
                                <td class="text-center">
                                    <span class="status">{{ $ad['phone'] }}</span>
                                </td>
                                <td class="budget text-center capitalize">
                                    {{ $ad['address'] }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-evenly action-col">
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
                                        <a href="{{ route('admin.userCustomerDel', ['id' => $ad['id']]) }}"
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
                    <p class="mb-0">No pasien data</p>
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
        var phone = $('#phoned' + val).val()
        var address = $('#address' + val).val()
        var birth = $('#birth' + val).val()
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
