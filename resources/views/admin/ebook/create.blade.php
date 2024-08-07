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
            <h4 class="page-title">Ebook</h4>
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
                    <a href="/master-admin/module">Modul</a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="">Tambah Ebook</a>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Data Ebook</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('ebook.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Judul</label>
                        <div class="input-group ">
                            <input type="text" value="{{ old('judul') }}" placeholder="Masukkan Judul Ebook"
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
                        <label>Kategori Konten Ebook</label>
                        <div class="input-group ">
                            <select name="id_kategori_konten_ebook" required class="form-control"
                                @error('id_kategori_konten_ebook') is-invalid @enderror>
                                <option value="">-- Pilih Kategori Konten Ebook --</option>
                                @foreach ($kategoriKontenEbook as $item)
                                    <option value="{{ $item->id }}">
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
                        <label>Kategori Ebook</label>
                        <div class="input-group ">
                            <select name="id_kategori_ebook" required class="form-control"
                                @error('id_kategori_ebook') is-invalid @enderror>
                                <option value="">-- Pilih Kategori Ebook --</option>
                                @foreach ($kategoriEbook as $item)
                                    <option value="{{ $item->id }}">
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
                        <label>Teks</label>
                        <textarea name="teks" id="ckeditor" autocomplete='off' class="form-control @error('teks') is-invalid @enderror"
                            cols="30" rows="8">{{ old('teks') }}</textarea>
                        @error('teks')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <h5><b>Pilih Format Pdf</b></h5>
                        <label>
                            <input type="radio" name="option" value="file" id="file" checked>
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
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <img id="preview" src="" alt="" class="rounded img-fluid" />
                        @error('gambar')
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
