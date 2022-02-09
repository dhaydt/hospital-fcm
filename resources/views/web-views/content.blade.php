@extends('layouts.front-end.app')

@section('content')
@if (Route::is('content2'))
    <div class="mt--5"></div>
@endif
<div class="con-content pt-0 my-6 pb-2">
    <div class="row">
        <div class="col-12">
            <div class="konten-header">
                <div class="konten-img">
                    <img src="{{ asset('storage/content').'/'.$blog->image }}" alt="" class="img-konten">
                </div>
                <div class="konten-title mt-1">
                    <h5 class="mb-0">
                        {{ $blog->title }}
                    </h5>
                </div>
                <div class="konten-body">
                    {!! $blog->description !!}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
