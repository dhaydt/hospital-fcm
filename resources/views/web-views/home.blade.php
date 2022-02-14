@extends('layouts.front-end.app')
<style>
    .img-link.video {
        height: 212px;
    }
</style>
@section('content')
<div class="container-fluid px-3 my-6">

    {{-- <form action="{{ route('send.notification') }}" method="POST">
        @csrf --}}
        {{-- <button onclick="sendNotif()" class="btn btn-primary">Send Notification</button> --}}
        {{--
    </form> --}}
    <div class="row">
        @if (!Route::is('home2'))
        <div class="col-12 mb-3">
            <div class="row px-2">
                @foreach ($cat as $c)
                <div class="col-4 px-2">
                    <div class="card menu-card mb-3">
                        <a href="{{ route('checkup-cat', ['id' => $c->id]) }}" class="img-menu">
                            <img src="{{ asset('storage/category').'/'.$c['image'] }}" class="card-img-top"
                                alt="menu-img">
                        </a>
                        <div class="menu-cate">
                            <label class="menu-title mb-0">{{ $c->name }}</label>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        <div class="col-12">
            <h4 class="section-title">
                Video Edukasi bagi anda
            </h4>
            @foreach ($video as $v)
            <div class="card blog-card mb-3">
                <a href="{{ route('content.view', ['id' => $v->id]) }}" class="img-link video">
                    <iframe id="ytplayer" type="text/html" class="card-img-top h-100" src="{{ $v->url }}"
                        frameborder="0"></iframe>
                    {{-- <img src="{{ asset('storage/content').'/'.$b['image'] }}" class="card-img-top" alt="blog-img"> --}}
                </a>
                <div class="card-body p-2">
                    <h5 class="card-title capitalize">{{ $v->title }}</h5>
                </div>
            </div>
            @endforeach
        </div>

        <div class="col-12">
            <h4 class="section-title">
                Edukasi bagi anda
            </h4>

            @foreach ($blog as $b)
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
    </div>
</div>
@endsection
@push('script')
<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    function sendNotif(){
        console.log('work');
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route("getKembali") }}',
                    type: 'GET',

                    // dataType: 'JSON',
                    success: function (response) {
                        console.log('notif sended successfully.');
                    },
                    error: function (err) {
                        console.log('User Chat Token Error'+ err);
                    },
                });
    }

    var firebaseConfig = {
        apiKey: "AIzaSyDNHG694SRE2nSW7Dc276dctM2dyPi_w2w",
        authDomain: "fcm-demo-60928.firebaseapp.com",
        projectId: "fcm-demo-60928",
        storageBucket: "fcm-demo-60928.appspot.com",
        messagingSenderId: "94836916481",
        appId: "1:94836916481:web:4f3e73638d139cae1c9b00"
    };

    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
            messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                console.log(token);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route("save-token") }}',
                    type: 'POST',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        console.log('Token saved successfully.');
                    },
                    error: function (err) {
                        console.log('User Chat Token Error'+ err);
                    },
                });

            }).catch(function (err) {
                console.log('User Chat Token Error'+ err);
            });
     }

    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(noteTitle, noteOptions);
    });

    $(document).ready(function(){
        initFirebaseMessagingRegistration();
        sendNotif()
    })

</script>
@endpush
