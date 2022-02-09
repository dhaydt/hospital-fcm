@extends('layouts.backend.app')
@section('title', 'Pasien Checkup')
@section('content')
@include('admin-views.checkup._headerPage')
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

    .status.badge {
        font-size: 85%;
        border-radius: 20px;
    }

    .pasien-dialog {
        margin-top: 30vh;
    }
</style>
<div class="container-fluid mt--8">

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col" class="sort" data-sort="name">NO</th>
                                <th scope="col" class="sort" data-sort="budget">Nama</th>
                                <th scope="col" class="sort" data-sort="category">Layanan</th>
                                <th scope="col" class="sort" data-sort="status">Telepon / HP</th>
                                <th scope="col" class="sort" data-sort="status">Datang</th>
                                <th scope="col" class="sort" data-sort="status">Imunisasi selanjutnya</th>
                                <th scope="col" class="sort" data-sort="status">Kembali</th>
                                <th scope="col" class="sort" data-sort="completion">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @if (count($admin) > 0)
                            <?php $no = 1;?>
                            @foreach ($admin as $ad)
                            {{-- Modal --}}
                            <div class="modal fade" id="staticBackdrop-{{ $ad->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog pasien-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title capitalize" id="staticBackdropLabel">Update {{
                                                $ad->customer->name }}</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-3 pasien-form">
                                                <div class="input-group input-group-merge input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span
                                                            class="input-group-text w-100 bg-grey text-white">Datang</span>
                                                    </div>
                                                    <input class="pl-2 form-control" name="name"
                                                        value="{{ date('d M Y',strtotime($ad->datang)) }}"
                                                        disabled></input>
                                                </div>
                                            </div>
                                            @if ($ad->cat_id == 5)
                                            <div class="form-group mb-3 pasien-form">
                                                <div class="input-group input-group-merge input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span
                                                            class="input-group-text w-100 bg-grey text-white">Nama</span>
                                                    </div>
                                                    <input class="pl-2 form-control" id="next{{ $ad->id }}" name="next" type="text"
                                                        placeholder="Imunisasi selanjutnya"
                                                        ></input>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="form-group mb-3 pasien-form">
                                                <div class="input-group input-group-merge input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span
                                                            class="input-group-text w-100 bg-grey text-white">Kembali</span>
                                                    </div>
                                                    <input class="pl-2 form-control" id="back{{ $ad->id }}" name="kembali"
                                                        type="date"
                                                        value="{{ date('d M Y',strtotime($ad->kembali)) }}"></input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Keluar</button>
                                            <button type="button" class="btn btn-primary"
                                                onclick="update({{ $ad->id }})">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal --}}
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="budget text-center capitalize">
                                    <span class="status">{{ $ad->customer->name }}</span>
                                </td>
                                <td class="budget text-center capitalize">
                                    <span class="status">{{ $ad->category }}</span>
                                </td>
                                <td class="budget text-center capitalize">
                                    <span class="status">{{ $ad->customer->phone }}</span>
                                </td>
                                <td class="budget text-center capitalize">
                                    <span class="status badge badge-success">{{ date('d M Y',strtotime($ad->datang))
                                        }}</span>
                                </td>
                                <td class="budget text-center capitalize">
                                @if (isset($ad->next_service))
                                <span class="status">{{ $ad->next_service }}</span>
                                @endif
                                </td>
                                <td class="budget text-center capitalize">
                                    @if ($ad->kembali == null)
                                    <span class="status badge badge-danger">Belum di atur</span>

                                    @else
                                    <span class="status badge badge-success">{{ date('d M Y',strtotime($ad->kembali))
                                        }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-evenly action-col">
                                        {{-- <a href="{{ route('admin.userCustomerView', ['id' => $ad['id']]) }}"
                                            class="viewUser btn p-1">
                                            <i class="far fa-eye"></i>
                                        </a> --}}
                                        <a href="javascript:" class="viewUser btn p-1" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop-{{ $ad->id }}">
                                            <i class="far fa-edit text-success"></i>
                                        </a>
                                        <a href="{{ route('admin.checkup.delete', ['id' =>  $ad->id ]) }}" class="viewUser btn p-1">
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
        var back = $('#back' + val).val()
        var next = $('#next' + val).val()
        // console.log(id, back)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('admin.checkup.update')}}",
            method: 'POST',
            data: {id: id, kembali: back, next: next},
            success: function () {
                toastr.success('Tanggal kembali berhasil diubah');
                location.reload();
            }
        });
    }
    </script>
