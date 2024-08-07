@extends('layouts.member')

@section('content')
    <br><br><br><br>
    <div class="container mt-3 py-5 mb-5">
        <div class="col-lg-8 mt-3 wow fadeInUp" data-wow-delay="0.5s">
            <h2 style="color: #9d0c47;">Lokasi Kantor</h2>
            <div>
                <label for="">Alamat : </label><br>
                Jl. KH. Noer Ali No.201, RT.008/RW.005, Kayuringin Jaya, Kec. Bekasi Sel., Kota Bks, Jawa Barat 17144
                <br><br>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                placeholder="Masukan nama" />
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="subject">Nama Lengkap</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Masukan email" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="subject">Email</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control @error('pesan') is-invalid @enderror" name="pesan" style="height: 200px"
                                placeholder="Masukan pesan anda"></textarea>
                            @error('pesan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="message">Pesan</label>
                        </div>
                    </div>
                    {{-- <div class="col-12 mt-2 mb-2">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                        @endif
                    </div> --}}
                    <div class="col-12">
                        <button class="btn px-4 text-white" style="background: rgb(13, 76, 222);" type="submit"
                            id="sendMessageButton">Kirim Pesan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
