@extends('layouts.backend.app')
@section('title', 'Konten')
@section('content')
@include('admin-views.video.partials._headerPage')
<style>
    #changeImg {
        position: absolute;
        opacity: 0;
    }

    #imgPict {
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
                    <form action="{{ route('admin.video.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Judul video">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Video Link <small class="text-danger">(URL Youtube)</small></label>
                            <input type="text" class="form-control" id="ytUrl" name="url" placeholder="Url Video">
                            <input type="hidden" class="form-control" id="ytUrlSave" name="urlSave" value="">
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="col-md-6 pl-0">
                                <div class="" style="text-align: left">
                                    <label for="title" class="form-label">Category</label>
                                    <select name="category" class="form-select" aria-label="Default select example">
                                        <option selected value="">Pilih Kategori Video</option>
                                        @foreach ($cat as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <iframe id="ytplayer" type="text/html" width="480" height="240" src=""
                                    frameborder="0"></iframe>
                            </div>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <textarea name="description" class="editor textarea" cols="30" rows="10"
                                required></textarea>
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
    $("#ytUrl").change(function () {
        var url = $('#ytUrl').val()
            fbimagereadURL(url);
        });

        function fbimagereadURL(input) {
            if (input != undefined || url != '') {
            var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
            var match = input.match(regExp);
            if (match && match[2].length == 11) {
                // Do anything for being valid
                // if need to change the url to embed url then use below line
                // $('#ytplayerSide').attr('src', 'https://www.youtube.com/embed/' + match[2] + '?autoplay=0');
                var replace = input.replace(/watch\?v=/g, "embed/")
                console.log(replace);
                        $('#ytplayer').attr('src', replace);
                        $('#ytUrlSave').attr('value', replace);
            }
            else {
                alert('Link / URL Video salah!')
                }
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
