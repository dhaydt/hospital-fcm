@extends('layouts.front-end.app')

@section('content')
<div class="container-fluid px-3 my-6">
    <div class="row">
        <div class="col-12">
            <form class="" autocomplete="off" action="{{route('profile.user-update')}}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 text-center d-flex flex-column align-items-center">
                        <div class="avatar avatar-profile">
                            <img id="blah" onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                src="{{ asset('storage/profile').'/'.$customer->image }}" alt="">
                        </div>
                        <label for="files" style="cursor: pointer; color:{{$web_config['primary_color']}};"
                            class="spandHeadO">
                            Ganti foto profil
                        </label>
                        <input id="files" name="image" style="visibility:hidden;" type="file">
                    </div>
                </div>
                <div class="card card-checkup mt--3 mb-4">
                    <div class="card-body p-2">
                        <div class="form-group mb-2">
                            <label class="field-title">Nama Lengkap</label><br>
                            <input type="text" value="{{ $customer->name }}" name="name" required id="name"
                                class="form-control edit-profiles"></input>
                        </div>
                        <div class="form-group mb-2">
                            <label class="field-title">Tanggal Lahir</label><br>
                            <input type="date" disabled value="{{ $customer->birth_date }}"
                                class="form-control edit-profiles"></input>
                        </div>
                        <div class="form-group mb-2">
                            <label class="field-title">Alamat lengkap</label><br>
                            <input type="text" value="{{ $customer->address }}" name="address" required id="address"
                                class="form-control edit-profiles"></input>
                        </div>
                        <div class="form-group mb-2">
                            <label class="field-title">Nomor Handphone</label><br>
                            <input type="text" value="{{ $customer->phone }}" name="phone" required id="phone"
                                class="form-control edit-profiles"></input>
                        </div>
                        <div class="form-group mb-2">
                            <label class="field-title" for="si-password">Password Baru</label>
                            <div class="password-toggle">
                                <input class="form-control edit-profiles" name="password" value="" autocomplete="off"
                                    type="password" id="password">
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label for="newPass" class="field-title">Konfirmasi Password </label>
                            <div class="password-toggle">
                                <input class="form-control edit-profiles" name="con_password" type="password"
                                    id="confirm_password">
                                <div>
                                </div>
                            </div>
                            <div id='message'></div>
                        </div>

                        <div class="nav-profiile col-12 my-3">
                            <button type="submit" class="btn btn-primary float-right">Simpan Data
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@push('script')
<script src="{{asset('assets/front-end')}}/vendor/nouislider/distribute/nouislider.min.js"></script>
<script src="{{asset('assets/back-end/js/croppie.js')}}"></script>
<script>
    function checkPasswordMatch() {
            var password = $("#password").val();
            var confirmPassword = $("#confirm_password").val();
            $("#message").removeAttr("style");
            $("#message").html("");
            if (confirmPassword == "") {
                $("#message").attr("style", "color:black;font-size: 12px;");
                $("#message").html("Please ReType Password");

            } else if (password == "") {
                $("#message").removeAttr("style");
                $("#message").html("");

            } else if (password != confirmPassword) {
                $("#message").html("Passwords tidak sama");
                $("#message").attr("style", "color:red; font-size: 12px;");
            } else if (confirmPassword.length < 4) {
                $("#message").html("Password minimal 4 huruf");
                $("#message").attr("style", "color:redfont-size: 12px;");
            } else {

                $("#message").html("Passwords sama.");
                $("#message").attr("style", "color:green;font-size: 12px;");
            }

        }

        $(document).ready(function () {
            $("#confirm_password").keyup(checkPasswordMatch);

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#files").change(function () {
            readURL(this);
        });

</script>
@endpush
