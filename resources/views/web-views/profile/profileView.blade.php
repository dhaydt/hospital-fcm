@extends('layouts.front-end.app')

@section('content')
<div class="container-fluid px-3 my-6">
    <div class="set-div">
        <a href="{{ route('profile.edit') }}"><i class="fas fa-cog mr-2"></i></a>
        <a href="{{ route('customersLogout') }}"><i class="fas fa-door-open"></i></a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="avatar avatar-profile">
                        <img src="{{ asset('storage/profile').'/'.$data->image }}" alt="">
                    </div>
                </div>
            </div>
            <div class="card card-checkup my-3">
                <div class="card-body p-2">
                    <div class="field-group">
                        <span class="field-title">Nama Lengkap</span><br>
                        <h5 class="field-content">{{ $data->name }}</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Tanggal Lahir</span><br>
                        <h5 class="field-content">{{ date('d-m-Y', strtotime($data->birth_date))}}</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Alamat lengkap</span><br>
                        <h5 class="field-content address">{{ $data->address }}</h5>
                    </div>
                    <div class="field-group">
                        <span class="field-title">Nomor Handphone</span><br>
                        <h5 class="field-content">{{ $data->phone }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
