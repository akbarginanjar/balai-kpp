@extends('layouts.member')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8  bg-light p-30" style="box-shadow: 0px 3px 20px rgba(0, 0, 0, 0.15); border-radius: 7px;">
                <h3 class="mb-4"><img src="{{ asset('images/SUMEDANG.png') }}" width="300" alt="Logo"></h3>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label class="label">Alamat Email</label>
                        <div class="input-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Masukan email"
                                autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Password</label>
                        <div class="input-group mb-2">
                            <input id="myInput" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                autocomplete="current-password" placeholder="Masukan password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="checkbox" onclick="myFunction()" class="mr-1">Lihat Password
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success mt-2 text-white submit-btn btn-block">Login</button>
                    </div>
                    <div class="text-block text-center my-3">
                        <span class="text-small font-weight-semibold">Belum punya akun? </span>
                        <a href="{{ route('register') }}" class="text-black text-small">Daftar disini</a>
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
    </script>
@endsection
