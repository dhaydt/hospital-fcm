@extends('layouts.backend.app')
@section('title', 'Konten')
@section('content')
@include('admin-views.content._headerPage')
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

    .img-list {
        height: 80px;
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
                                <th scope="col" class="sort" data-sort="budget">Judul</th>
                                <th scope="col" class="sort" data-sort="category">Kategori</th>
                                {{-- <th scope="col" class="sort" data-sort="status">Deskripsi</th> --}}
                                <th scope="col" class="sort" data-sort="status">Image</th>
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
                                <div class="modal-dialog modal-lg pasien-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title capitalize" id="staticBackdropLabel">Update {{
                                                $ad->title }}</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form id="updateForm" action="{{ route('admin.content.update') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $ad->id }}">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="title" value="{{ $ad->title }}" name="title">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Category</label>
                                                    <select name="category" class="form-select" aria-label="Default select example">
                                                        <option selected value="{{ $ad->cat_id }}"> {{ $ad->category->name }}</option>
                                                        @foreach ($cat as $c)
                                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                        @endforeach
                                                      </select>
                                                </div>
                                                <div class="mb-3 d-flex">
                                                    <div class="col-md-6 pl-0">
                                                        <div class="custom-file" style="text-align: left">
                                                            <input type="file" name="image" id="fbimageFileUploaders"
                                                                class="custom-file-input"
                                                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                                            <label class="custom-file-label"
                                                                for="fbimageFileUploader">Change Image</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <center>
                                                            <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px; max-width:100%;"
                                                                id="fbImageviewer"
                                                                src="{{ asset('storage/content/'.$ad->image) }}"
                                                                alt="banner image" />
                                                        </center>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Description</label>
                                                    <textarea name="description" class="editor textarea" cols="30"
                                                        rows="10" required>{!! $ad->description !!}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Keluar</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal --}}
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="budget text-center capitalize">
                                    <span class="status">{{ $ad->title }}</span>
                                </td>
                                <td class="budget text-center capitalize">
                                    <span class="status">{{ $ad->category->name }}</span>
                                </td>
                                {{-- <td class="text-center capitalize">
                                    {!! $ad->description !!}
                                </td> --}}
                                <td class="budget text-center capitalize">
                                    <img alt="Image placeholder" class="img-list"
                                        src="{{ asset('storage/content/'.$ad->image) }}">
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
                                        <a href="{{ route('admin.content.delete', ['id' =>  $ad->id ]) }}"
                                            class="viewUser btn p-1">
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
                    <p class="mb-0">No konten data</p>
                </div>

                @endif
            </div>
        </div>
    </div>
    @endsection
    @push('script')
    <script>
        $("#fbimageFileUploaders").change(function () {
            fbimagereadURL(this);
        });

        function fbimagereadURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#fbImageviewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
    <script src="{{asset('/')}}vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="{{asset('/')}}vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>

    <script>
        $('.textarea').ckeditor({
            contentsLangDirection : '{{Session::get('direction')}}',
        });
    </script>
    @endpush
