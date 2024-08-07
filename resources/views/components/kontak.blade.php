@php
    use App\Models\Tb_setting;
    $setting = Tb_setting::find(1);
@endphp
<section id="contact" class="contact">
    <div class="row">
        <div class="col-lg-6">
            <h4 class="mb-3">Kirim pesan Kepada Admin</h4>
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" name="nama"
                                class="form-control @error('nama') is-invalid @enderror" placeholder="Masukan nama" />
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
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Masukan email" />
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
                        <button class="btn px-4 text-white" style="background: #2E4370;" type="submit"
                            id="sendMessageButton">Kirim Pesan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-6 mt-3 wow fadeInUp" data-wow-delay="0.5s">
            <div class="row gy-4">
                <div class="col-md-6">
                    <div class="info-box">
                        <i class="bi bi-telephone"></i>
                        <h3>No Telepon</h3>
                        <p>{{ $setting->call_us }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-box">
                        <i class="bi bi-envelope"></i>
                        <h3>Email</h3>
                        <p>{{ $setting->email_us }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-box">
                        <i class="bi bi-facebook"></i>
                        <h3>Facebook</h3>
                        <p>{{ $setting->email_us }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-box">
                        <i class="bi bi-instagram"></i>
                        <h3>Instagram</h3>
                        <p>{{ $setting->email_us }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
