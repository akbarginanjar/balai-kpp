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
            <h4 class="page-title">E-book</h4>
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
                    <a href="/master-admin/module">E-book</a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="">Edit E-book</a>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title col-sm-10">Edit Data E-book</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('ebook.update', $ebook->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Judul</label>
                        <div class="input-group ">
                            <input type="text" value="{{ $ebook->judul }}" placeholder="Masukkan Judul artikel"
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
                        <label>Kategori Konten E-book</label>
                        <div class="input-group ">
                            <select name="id_kategori_konten_ebook" required class="form-control"
                                @error('id_kategori_konten_ebook') is-invalid @enderror>
                                <option value="">-- Pilih Kategori Konten E-book --</option>
                                @foreach ($kategoriKontenEbook as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $ebook->id_kategori_konten_ebook == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kategori_konten_ebook')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kategori E-book</label>
                        <div class="input-group ">
                            <select name="id_kategori_ebook" required class="form-control"
                                @error('id_kategori_ebook') is-invalid @enderror>
                                <option value="">-- Pilih Kategori E-book --</option>
                                @foreach ($kategoriEbook as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $ebook->id_kategori_ebook == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kategori_ebook')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pembuatan</label>
                        <div class="input-group ">
                            <input type="date" value="{{ $ebook->tgl_pembuatan }}" name="tgl_pembuatan"
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
                            <input type="time" value="{{ $ebook->waktu_pembuatan }}" name="waktu_pembuatan"
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
                        <label>Teks</label>
                        <textarea name="teks" id="ckeditor" autocomplete='off' class="form-control @error('teks') is-invalid @enderror"
                            cols="30" rows="8">{{ $ebook->teks }}</textarea>
                        @error('teks')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <h5><b>Pilih Format Pdf</b></h5>
                        <label>
                            <input type="radio" name="option" value="file" id="file">
                            File
                        </label>
                        <label>
                            <input type="radio" name="option" value="link" id="link">
                            Link
                        </label>
                        <br>
                        <div id="input-link">
                            <label for="additional-link">Link Pdf:</label>
                            <input type="text" name="link" class="form-control" id="additional-link">
                        </div>
                        <div id="input-file">
                            <label for="additional-file">File Pdf:</label>
                            <input type="file" name="file" class="form-control" id="additional-file">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Upload File Gambar</label>
                        <div class="custom-file mb-3">
                            <input type="file" id="file" name="gambar"
                                class="custom-file-input @error('gambar') is-invalid @enderror" accept="image/*"
                                onchange="tampilkanPreview(this,'preview')" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose
                                file</label>
                        </div>
                        <div class="row">
                            <div class="col">
                                <img src="{{ $ebook->gambar() }}" class="rounded img-fluid" alt="">
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
                        @error('gambar')
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
        document.addEventListener('DOMContentLoaded', function() {
            const link = document.getElementById('link');
            const file = document.getElementById('file');
            const inputLink = document.getElementById('input-link');
            const inputFile = document.getElementById('input-file');

            inputFile.style.display = 'block';
            inputLink.style.display = 'none';

            link.addEventListener('change', function() {
                if (link.checked) {
                    inputLink.style.display = 'block';
                    inputFile.style.display = 'none';
                }
            });

            file.addEventListener('change', function() {
                if (file.checked) {
                    inputFile.style.display = 'block';
                    inputLink.style.display = 'none';
                }
            });
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
