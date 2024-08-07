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

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

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
                    <a href="/master-admin/video">Video</a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="">Edit Video</a>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title col-sm-10">Edit Data Video</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('video.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Judul</label>
                        <div class="input-group ">
                            <input type="text" value="{{ $video->judul }}" placeholder="Masukkan Judul Video"
                                name="judul" autocomplete='off' class="form-control @error('judul') is-invalid @enderror"
                                required>
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
                            <input type="text" value="{{ $video->link }}" placeholder="Masukkan link Video"
                                name="link" autocomplete='off' class="form-control @error('link') is-invalid @enderror"
                                required>
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
                                    <option value="{{ $item->id }}"
                                        {{ $video->id_kategori_video == $item->id ? 'selected' : '' }}>
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
                            <input type="date" value="{{ $video->tgl_pembuatan }}" name="tgl_pembuatan"
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
                            <input type="time" value="{{ $video->waktu_pembuatan }}" name="waktu_pembuatan"
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
                            class="form-control @error('deskripsi') is-invalid @enderror" cols="30" rows="8">{{ $video->deskripsi }}</textarea>
                        @error('deskripsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-warning text-white"><i class="fa fa-save mr-1"></i>
                            Simpan Perubahan</button>
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
