@extends('layouts.admin')

@section('ckeditor')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('ckeditor', {
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection

@section('js')
    <script src="{{ asset('assets/admin/js/jquery.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/select2.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

    <script>
        $(".theSelect").select2();
    </script>
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Video</h4>
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
                    <a href="/master-admin/module">Module</a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="">Tambah Video</a>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Data Video</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Judul</label>
                        <div class="input-group ">
                            <input type="text" value="{{ old('judul') }}" placeholder="Masukkan Judul " name="judul"
                                autocomplete='off' class="form-control @error('judul') is-invalid @enderror" required>
                            @error('judul')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <div class="input-group ">
                            <input type="text" value="{{ old('link') }}" placeholder="Masukkan link" name="link"
                                autocomplete='off' class="form-control @error('link') is-invalid @enderror" required>
                            @error('link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kategori Video</label>
                        <div class="input-group ">
                            <select name="id_kategori_video" required class="form-control"
                                @error('id_kategori_video') is-invalid @enderror>
                                <option value="">-- Pilih Kategori Video --</option>
                                @foreach ($kategoriVideo as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kategori_video')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pembuatan</label>
                        <div class="input-group ">
                            <input type="date" value="{{ old('tgl_pembuatan') }}" name="tgl_pembuatan" id="currentDate"
                                autocomplete='off' class="form-control @error('tgl_pembuatan') is-invalid @enderror"
                                required>
                            @error('tgl_pembuatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Waktu Pembuatan</label>
                        <div class="input-group ">
                            <input type="time" value="{{ old('waktu_pembuatan') }}" name="waktu_pembuatan"
                                autocomplete='off' class="form-control @error('waktu_pembuatan') is-invalid @enderror"
                                required>
                            @error('waktu_pembuatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" id="ckeditor" autocomplete='off'
                            class="form-control @error('deskripsi') is-invalid @enderror" cols="30" rows="8">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary text-white">
                            Simpan </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const dateInput = document.getElementById('currentDate');
            const today = new Date().toISOString().split('T')[0];
            dateInput.value = today;
        });
    </script>

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
                    reader.readAsDataURL(gbPreview);
                } else {
                    alert("file yang anda upload tidak sesuai. Khusus mengunakan image.");
                }

            }
        }
    </script>
@endsection
