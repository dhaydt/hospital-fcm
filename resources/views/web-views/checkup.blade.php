@extends('layouts.front-end.app')

@section('content')
<div class="con-content pt-0 my-6 pb-2">
    <div class="row">
        <div class="col-12">
            @if (count($data) > 0)
            @foreach ($data as $d)
            <div class="card card-checkup mb-3">
                <div class="bg-checkup">
                    <img src="{{ asset('assets/front-end/img/checkup-bg.jpeg') }}" alt="">
                </div>
                <div class="card-body p-2">
                    <div class="field-group">
                        <span class="field-title">Nama Layanan</span><br>
                        <h5 class="field-content">{{ $d->category }}</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Nama Lengkap</span><br>
                        <h5 class="field-content">{{ $d->customer->name }}</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal pemeriksaan</span><br>
                        <h5 class="field-content">{{ date('d-m-Y', strtotime($d->datang))}}</h5>
                    </div>
                    @if (isset($d->next_service))
                    <div class="field-group">
                        <span class="field-title">Imunisasi selanjutnya</span><br>
                        <h5 class="field-content">{{ $d->next_service }}</h5>
                    </div>
                    @endif
                    @if (isset($d->kembali))
                    <div class="field-group">
                        <span class="field-title">Pemeriksaan kembali</span><br>
                        <h3 class="field-content badge badge-success">{{ date('d M Y', strtotime($d->kembali)) }}</h3>
                    </div>
                    @else
                    <div class="field-group">
                        <span class="field-title">Pemeriksaan kembali</span><br>
                        <h3 class="field-content badge badge-danger text-danger" style="font-size: 14px; text-transform:unset;">Tidak ada tanggal kembali</h3>
                    </div>
                    @endif

                </div>
            </div>
            @endforeach
            @else
            <div class="card card-checkup mb-3">
                <div class="bg-checkup">
                    <img src="{{ asset('assets/front-end/img/checkup-bg.jpeg') }}" alt="">
                </div>
                <div class="card-body p-2">
                    <div class="field-group">
                        <span class="field-title">Nama Layanan</span><br>
                        <h5 class="field-content">{{ session()->get('page-title') }}</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Nama Lengkap</span><br>
                        <h5 class="field-content">{{ auth('customer')->user()->name }}</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal pemeriksaan</span><br>
                        <h5 class="field-content">-</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Pemeriksaan kembali</span><br>
                        <h5 class="field-content">-</h5>
                    </div>
                </div>
            </div>
            @endif
            @if (count($konten) > 0)
            <div class="col-12">
                <h4 class="section-title">
                    Edukasi {{ session()->get('page-title') }}
                </h4>
                @foreach ($konten as $b)
                <div class="card blog-card mb-3">
                    <a href="{{ route('content.view', ['id' => $b->id]) }}" class="img-link">
                        <img src="{{ asset('storage/content').'/'.$b['image'] }}" class="card-img-top" alt="blog-img">
                    </a>
                    <div class="card-body px-2 py-1">
                        <h5 class="card-title">{{ $b->title }}</h5>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
