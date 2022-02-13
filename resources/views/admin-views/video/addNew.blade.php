@extends('layouts.backend.app')
@section('title', 'Konten')
@section('content')
@include('admin-views.video.partials._headerPage')
<style>
    #changeImg {
        position: absolute;
        opacity: 0;
    }
    #imgPict{
        height: 180px;
        width: 180px;
        background-color: #fff;
    }
</style>
<div class="container mt--8">
    <div class="row">
        <div class="col">
            <div class="card p-3">
                <div class="card-title">Add New Video Content</div>
                <div class="card-body">
                    <form action="{{ route('admin.content.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Judul video">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Category</label>
                            <select name="category" class="form-select" aria-label="Default select example">
                                <option selected value="">Pilih Kategori Video</option>
                                @foreach ($cat as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                              </select>
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="col-md-6 pl-0">
                                <div class="" style="text-align: left">
                                    <label for="title" class="form-label">Video Link</label>
                            <input type="text" class="form-control" id="ytUrl" name="url" placeholder="Url Video">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <center>
                                    <x-embed url="https://youtu.be/dQRQ5tbpLPM?list=RDlJbaqPSlAeg" />
                                </center>
                            </div>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <textarea name="description" class="editor textarea" cols="30"
                            rows="10" required></textarea>
                        </div> --}}
                        <div class="text-end w-100">
                            <button type="submit" class="btn btn-primary text-end">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        $("#fbimageFileUploader").change(function () {
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
     {{--ck editor--}}
     <script src="{{asset('/')}}vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
     <script src="{{asset('/')}}vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
     <script>
         $('.textarea').ckeditor({
             contentsLangDirection : '{{Session::get('direction')}}',
         });
     </script>
     {{--ck editor--}}
@endpush
