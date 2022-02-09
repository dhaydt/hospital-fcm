@extends('layouts.backend.app')
@section('title', 'Konten')
@section('content')
@include('admin-views.content.partials._headerPage')
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
                <div class="card-title">Add New Content</div>
                <div class="card-body">
                    <form action="{{ route('admin.content.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Judul konten">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Category</label>
                            <select name="category" class="form-select" aria-label="Default select example">
                                <option selected value="">Pilih Kategori Konten</option>
                                @foreach ($cat as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                              </select>
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="col-md-6 pl-0">
                                <div class="custom-file" style="text-align: left">
                                    <input type="file" name="image" id="fbimageFileUploader"
                                           class="custom-file-input"
                                           accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                    <label class="custom-file-label"
                                           for="fbimageFileUploader">Add Image</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <center>
                                    <img
                                        style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;"
                                        id="fbImageviewer"
                                        src="{{asset('assets\back-end\img\400x400\img2.jpg')}}"
                                        alt="banner image"/>
                                </center>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            {{-- <textarea class="form-control" id="desc" name="desc"></textarea> --}}
                            <textarea name="description" class="editor textarea" cols="30"
                            rows="10" required></textarea>
                        </div>
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
