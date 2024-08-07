@extends('layouts.member')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8  bg-light p-30" style="box-shadow: 0px 3px 20px rgba(0, 0, 0, 0.15); border-radius: 7px;">
                <h3 class="text-center mb-4 text-success">Pendaftaran Pengguna Baru</h3>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="label">Nama Lengkap</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" placeholder="Masukan nama lengkap"
                            autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="label">Alamat Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" placeholder="Masukan alamat email"
                            autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_telepon" class="label">No Telepon</label>
                        <input id="no_telepon" type="number" class="form-control @error('no_telepon') is-invalid @enderror"
                            name="no_telepon" value="{{ old('no_telepon') }}" placeholder="Masukan nomor telepon"
                            autocomplete="no_telepon">

                        @error('no_telepon')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" placeholder="Masukan password" autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="password-confirm" class="label">Konfirmasi password</label>
                        <input id="password" type="password" class="form-control" name="password_confirmation"
                            autocomplete="new-password" placeholder="Masukan konfirmasi password">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">
                            Daftar
                        </button>
                    </div>
                    <div class="text-block text-center my-3">
                        <span class="text-small font-weight-semibold">Sudah punya akun? </span>
                        <a href="{{ route('login') }}" class="text-black text-small">Login disini</a>
                    </div>
                </form>
            </div>
        </div>
    </div><br><br>

    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function confirm() {
            var x = document.getElementById("confirm");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endsection
