@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#setting').DataTable();
        });
    </script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Setting</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="/master-admin/dashboard">
                        <i class="fa-solid fa-house-chimney"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="/master-admin/setting">Setting</a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="">Data Setting</a>
                </li>
            </ul>

        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Judul</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Lokasi</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Media Sosial</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <div class="card-title"> Data Judul</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="/master-admin/setting/judul" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        {{-- <div class="form-group">
                                            <label>Icon</label>
                                            <div class="custom-file mb-3">
                                                <input type="file" id="file" name="icon"
                                                    class="custom-file-input @error('icon') is-invalid @enderror"
                                                    accept="image/*" onchange="tampilkanPreview(this,'preview')"
                                                    id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose
                                                    file</label>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <a href="{{ $setting->icon() }}" data-caption="Icon"
                                                        data-fancybox="gallery">
                                                        <img src="{{ $setting->icon ? $setting->icon() : 'no_image' }}"
                                                            class="rounded img-fluid" width="120px" alt=""></a>
                                                </div>
                                                <div class="col">
                                                    <center>
                                                        <span id="panah"></span>
                                                    </center>
                                                </div>
                                                <div class="col">
                                                    <img id="preview" src="" alt=""
                                                        class="rounded img-fluid float-right" />
                                                </div>
                                            </div>
                                            @error('icon')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> --}}
                                        <div class="form-group">
                                            <label>Judul</label>
                                            <div class="input-group ">
                                                <input type="text" value="{{ $setting->judul }}"
                                                    placeholder="Masukkan judul" name="judul" autocomplete='off'
                                                    class="form-control @error('judul') is-invalid @enderror">
                                                @error('judul')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group mt-4">
                                            <button type="submit" class="btn btn-primary">Publish</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <div class="card-title"> Data Lokasi</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="/master-admin/setting/lokasi" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <div class="input-group ">
                                                <textarea value="{{ $setting->alamat }}" rows="4" placeholder="Masukkan alamat" name="alamat" autocomplete='off'
                                                    class="form-control @error('alamat') is-invalid @enderror">{{ $setting->alamat }}</textarea>
                                                @error('alamat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Call Us</label>
                                            <div class="input-group ">
                                                <input type="number" value="{{ $setting->call_us }}"
                                                    placeholder="Masukkan call_us" name="call_us" autocomplete='off'
                                                    class="form-control @error('call_us') is-invalid @enderror">
                                                @error('call_us')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Email Us</label>
                                            <div class="input-group ">
                                                <input type="text" value="{{ $setting->email_us }}"
                                                    placeholder="Masukkan email_us" name="email_us" autocomplete='off'
                                                    class="form-control @error('email_us') is-invalid @enderror">
                                                @error('email_us')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group mt-4">
                                            <button type="submit" class="btn btn-primary">
                                                Publish</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <div class="card-title"> Data Media Sosial</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="/master-admin/setting/medsos" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Facebook</label>
                                            <div class="input-group ">
                                                <input type="text" value="{{ $setting->facebook }}"
                                                    placeholder="Masukkan facebook" name="facebook" autocomplete='off'
                                                    class="form-control @error('facebook') is-invalid @enderror">
                                                @error('facebook')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Instagram</label>
                                            <div class="input-group ">
                                                <input type="text" value="{{ $setting->instagram }}"
                                                    placeholder="Masukkan instagram" name="instagram" autocomplete='off'
                                                    class="form-control @error('instagram') is-invalid @enderror">
                                                @error('instagram')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>TikTok</label>
                                            <div class="input-group ">
                                                <input type="text" value="{{ $setting->twitter }}"
                                                    placeholder="Masukkan twitter" name="twitter" autocomplete='off'
                                                    class="form-control @error('twitter') is-invalid @enderror">
                                                @error('twitter')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="form-group hidden">
                                            <label>Linkedin</label>
                                            <div class="input-group ">
                                                <input type="text" value="{{ $setting->linkedin }}"
                                                    placeholder="Masukkan linkedin" name="linkedin" autocomplete='off'
                                                    class="form-control @error('linkedin') is-invalid @enderror">
                                                @error('linkedin')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> --}}
                                        <div class="form-group mt-4">
                                            <button type="submit" class="btn btn-primary">
                                                Publish</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    <script>
        function tampilkanPreview(gambar, idpreview) {
            var gb = gambar.files;
            for (var i = 0; i < gb.length; i++) {
                var gbPreview = gb[i];
                var imageType = /image.*/;
                var preview = document.getElementById(idpreview);
                var reader = new FileReader();

                if (gbPreview.type.match(imageType)) {
                    preview.file = gbPreview;
                    reader.onload = (function(element) {
                        return function(e) {
                            element.src = e.target.result;
                        };
                    })(preview);
                    document.getElementById("panah").innerHTML =
                        "<br><img src='{{ asset('images/arrow.png') }}' width='90'>";
                    reader.readAsDataURL(gbPreview);
                } else {
                    alert("file yang anda upload tidak sesuai. Khusus mengunakan image.");
                }

            }
        }
    </script>
@endsection
