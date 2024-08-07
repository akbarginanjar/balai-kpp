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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Halaman</h4>
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
                    <a href="/master-admin/halaman">Halaman</a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="">Edit Halaman</a>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title col-sm-10">Edit Data Halaman</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('halaman.update', $halaman->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Judul</label>
                        <div class="input-group ">
                            <input type="text" value="{{ $halaman->judul }}" placeholder="Masukkan Judul halaman"
                                name="judul" autocomplete='off' class="form-control @error('judul') is-invalid @enderror">
                            @error('judul')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>

                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Teks</label>
                        <textarea name="teks" id="ckeditor" autocomplete='off' class="form-control @error('teks') is-invalid @enderror"
                            cols="30" rows="8">{{ $halaman->teks }}</textarea>
                        @error('teks')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
                                <img src="{{ $halaman->gambar() }}" class="rounded img-fluid" alt="">
                            </div>
                            <div class="col">
                                <center>
                                    <span id="panah"></span>
                                </center>
                            </div>
                            <div class="col">
                                <img id="preview" src="" alt="" class="rounded img-fluid float-right" />
                            </div>
                        </div>
                        @error('gambar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- Atas --}}
                    <div class="form-group row">
                        <div class="form-group col">
                            <label>Atas Kiri</label>
                            <div class="input-group ">

                                <select name="atas_kiri" required
                                    class="form-control form-control
                                theSelect"
                                    @error('atas_kiri') is-invalid @enderror>
                                    <option value="Tidak" {{ $halaman->atas_kiri == 'Tidak' ? 'selected' : '' }}>Tidak
                                        Ditampilkan</option>
                                    <option value="Slide" {{ $halaman->atas_kiri == 'Slide' ? 'selected' : '' }}>Slide
                                    </option>
                                    <option value="Galeri" {{ $halaman->atas_kiri == 'Galeri' ? 'selected' : '' }}>Galeri
                                    </option>
                                    <option value="Kontak" {{ $halaman->atas_kiri == 'Kontak' ? 'selected' : '' }}>
                                        Kontak
                                    </option>
                                    {{-- <option value="Artikel" {{ $halaman->atas_kiri == 'Artikel' ? 'selected' : '' }}>
                                        Artikel
                                    </option> --}}

                                </select>
                                @error('atas_kiri')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col">
                            <label>Atas Tengah</label>
                            <div class="input-group ">

                                <select name="atas_tengah" required
                                    class="form-control form-control
                                theSelect"
                                    @error('atas_tengah') is-invalid @enderror>
                                    <option value="Tidak" {{ $halaman->atas_tengah == 'Tidak' ? 'selected' : '' }}>Tidak
                                        Ditampilkan</option>
                                    <option value="Slide" {{ $halaman->atas_tengah == 'Slide' ? 'selected' : '' }}>Slide
                                    </option>
                                    <option value="Galeri" {{ $halaman->atas_tengah == 'Galeri' ? 'selected' : '' }}>Galeri
                                    </option>
                                    <option value="Kalender" {{ $halaman->atas_tengah == 'Kalender' ? 'selected' : '' }}>
                                        Kalender
                                    </option>
                                    <option value="Kontak" {{ $halaman->atas_tengah == 'Kontak' ? 'selected' : '' }}>
                                        Kontak
                                    </option>
                                    @foreach ($kategoriKontenEbook as $dataKategoriKontenEbook)
                                        <option value="{{ $dataKategoriKontenEbook->id }},ebook"
                                            {{ $halaman->atas_tengah == $dataKategoriKontenEbook->id . ',ebook' ? 'selected' : '' }}>
                                            E-book | {{ $dataKategoriKontenEbook->nama }}
                                        </option>
                                    @endforeach
                                    @foreach ($kategoriKonten as $dataKategoriKonten)
                                        <option value="{{ $dataKategoriKonten->id }},konten"
                                            {{ $halaman->atas_tengah == $dataKategoriKonten->id . ',konten' ? 'selected' : '' }}>
                                            Konten | {{ $dataKategoriKonten->nama }}
                                        </option>
                                    @endforeach
                                    {{-- <option value="Artikel" {{ $halaman->atas_tengah == 'Artikel' ? 'selected' : '' }}>
                                        Artikel
                                    </option> --}}

                                </select>
                                @error('atas_tengah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col">
                            <label>Atas Kanan</label>
                            <div class="input-group ">

                                <select name="atas_kanan" required
                                    class="form-control form-control
                                theSelect"
                                    @error('atas_kanan') is-invalid @enderror>
                                    <option value="Tidak" {{ $halaman->atas_kanan == 'Tidak' ? 'selected' : '' }}>Tidak
                                        Ditampilkan</option>
                                    <option value="Slide" {{ $halaman->atas_kanan == 'Slide' ? 'selected' : '' }}>Slide
                                    </option>
                                    <option value="Galeri" {{ $halaman->atas_kanan == 'Galeri' ? 'selected' : '' }}>Galeri
                                    </option>

                                    <option value="Kontak" {{ $halaman->atas_kanan == 'Kontak' ? 'selected' : '' }}>
                                        Kontak
                                    </option>
                                    <option value="Kalender Widget"
                                        {{ $halaman->atas_kanan == 'Kalender Widget' ? 'selected' : '' }}>
                                        Kalender Widget
                                    </option>
                                    {{-- <option value="Artikel" {{ $halaman->atas_kanan == 'Artikel' ? 'selected' : '' }}>
                                        Artikel
                                    </option> --}}

                                </select>
                                @error('atas_kanan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Tengah --}}
                    <div class="form-group row">
                        <div class="form-group col">
                            <label>Tengah Kiri</label>
                            <div class="input-group ">

                                <select name="tengah_kiri" required
                                    class="form-control form-control
                                theSelect"
                                    @error('tengah_kiri') is-invalid @enderror>
                                    <option value="Tidak" {{ $halaman->tengah_kiri == 'Tidak' ? 'selected' : '' }}>Tidak
                                        Ditampilkan</option>
                                    <option value="Slide" {{ $halaman->tengah_kiri == 'Slide' ? 'selected' : '' }}>Slide
                                    </option>
                                    <option value="Galeri" {{ $halaman->tengah_kiri == 'Galeri' ? 'selected' : '' }}>
                                        Galeri
                                    </option>

                                    <option value="Kontak" {{ $halaman->tengah_kiri == 'Kontak' ? 'selected' : '' }}>
                                        Kontak
                                    </option>
                                    {{-- <option value="Artikel" {{ $halaman->tengah_kiri == 'Artikel' ? 'selected' : '' }}>
                                        Artikel
                                    </option> --}}
                                </select>
                                @error('tengah_kiri')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col">
                            <label>Tengah</label>
                            <div class="input-group ">

                                <select name="tengah" required
                                    class="form-control form-control
                                theSelect"
                                    @error('tengah') is-invalid @enderror>
                                    <option value="Tidak" {{ $halaman->tengah == 'Tidak' ? 'selected' : '' }}>Tidak
                                        Ditampilkan</option>
                                    <option value="Slide" {{ $halaman->tengah == 'Slide' ? 'selected' : '' }}>Slide
                                    </option>
                                    <option value="Galeri" {{ $halaman->tengah == 'Galeri' ? 'selected' : '' }}>Galeri
                                    </option>

                                    <option value="Kontak" {{ $halaman->tengah == 'Kontak' ? 'selected' : '' }}>
                                        Kontak
                                    </option>
                                    @foreach ($kategoriKontenEbook as $dataKategoriKontenEbook)
                                        <option value="{{ $dataKategoriKontenEbook->id }},ebook"
                                            {{ $halaman->tengah == $dataKategoriKontenEbook->id . ',ebook' ? 'selected' : '' }}>
                                            E-book | {{ $dataKategoriKontenEbook->nama }}
                                        </option>
                                    @endforeach
                                    @foreach ($kategoriKonten as $dataKategoriKonten)
                                        <option value="{{ $dataKategoriKonten->id }},konten"
                                            {{ $halaman->tengah == $dataKategoriKonten->id . ',konten' ? 'selected' : '' }}>
                                            Konten | {{ $dataKategoriKonten->nama }}
                                        </option>
                                    @endforeach
                                    <option value="Kalender" {{ $halaman->tengah == 'Kalender' ? 'selected' : '' }}>
                                        Kalender
                                    </option>
                                    {{-- <option value="Artikel" {{ $halaman->tengah == 'Artikel' ? 'selected' : '' }}>
                                        Artikel
                                    </option> --}}

                                </select>
                                @error('tengah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col">
                            <label>Tengah Kanan</label>
                            <div class="input-group ">

                                <select name="tengah_kanan" required
                                    class="form-control form-control
                                theSelect"
                                    @error('tengah_kanan') is-invalid @enderror>
                                    <option value="Tidak" {{ $halaman->tengah_kanan == 'Tidak' ? 'selected' : '' }}>Tidak
                                        Ditampilkan</option>
                                    <option value="Slide" {{ $halaman->tengah_kanan == 'Slide' ? 'selected' : '' }}>Slide
                                    </option>
                                    <option value="Galeri" {{ $halaman->tengah_kanan == 'Galeri' ? 'selected' : '' }}>
                                        Galeri
                                    </option>

                                    <option value="Kontak" {{ $halaman->tengah_kanan == 'Kontak' ? 'selected' : '' }}>
                                        Kontak
                                    </option>
                                    {{-- <option value="Artikel" {{ $halaman->tengah_kanan == 'Artikel' ? 'selected' : '' }}>
                                        Artikel
                                    </option> --}}

                                </select>
                                @error('tengah_kanan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Bawah --}}
                    <div class="form-group row">
                        <div class="form-group col">
                            <label>Bawah Kiri</label>
                            <div class="input-group ">

                                <select name="bawah_kiri" required
                                    class="form-control form-control
                                theSelect"
                                    @error('bawah_kiri') is-invalid @enderror>
                                    <option value="Tidak" {{ $halaman->bawah_kiri == 'Tidak' ? 'selected' : '' }}>Tidak
                                        Ditampilkan</option>
                                    <option value="Slide" {{ $halaman->bawah_kiri == 'Slide' ? 'selected' : '' }}>Slide
                                    </option>
                                    <option value="Galeri" {{ $halaman->bawah_kiri == 'Galeri' ? 'selected' : '' }}>
                                        Galeri
                                    </option>

                                    <option value="Kontak" {{ $halaman->bawah_kiri == 'Kontak' ? 'selected' : '' }}>
                                        Kontak
                                    </option>

                                    {{-- <option value="Artikel" {{ $halaman->bawah_kiri == 'Artikel' ? 'selected' : '' }}>
                                        Artikel
                                    </option> --}}
                                </select>
                                @error('bawah_kiri')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col">
                            <label>Bawah Tengah</label>
                            <div class="input-group ">

                                <select name="bawah_tengah" required
                                    class="form-control form-control
                                theSelect"
                                    @error('bawah_tengah') is-invalid @enderror>
                                    <option value="Tidak" {{ $halaman->bawah_tengah == 'Tidak' ? 'selected' : '' }}>
                                        Tidak
                                        Ditampilkan</option>
                                    <option value="Slide" {{ $halaman->bawah_tengah == 'Slide' ? 'selected' : '' }}>
                                        Slide
                                    </option>
                                    <option value="Galeri" {{ $halaman->bawah_tengah == 'Galeri' ? 'selected' : '' }}>
                                        Galeri
                                    </option>
                                    <option value="Kalender" {{ $halaman->bawah_tengah == 'Kalender' ? 'selected' : '' }}>
                                        Kalender
                                    </option>
                                    <option value="Kontak" {{ $halaman->bawah_tengah == 'Kontak' ? 'selected' : '' }}>
                                        Kontak
                                    </option>
                                    @foreach ($kategoriKontenEbook as $dataKategoriKontenEbook)
                                        <option value="{{ $dataKategoriKontenEbook->id }},ebook"
                                            {{ $halaman->bawah_tengah == $dataKategoriKontenEbook->id . ',ebook' ? 'selected' : '' }}>
                                            E-book | {{ $dataKategoriKontenEbook->nama }}
                                        </option>
                                    @endforeach
                                    @foreach ($kategoriKonten as $dataKategoriKonten)
                                        <option value="{{ $dataKategoriKonten->id }},konten"
                                            {{ $halaman->bawah_tengah == $dataKategoriKonten->id . ',konten' ? 'selected' : '' }}>
                                            Konten | {{ $dataKategoriKonten->nama }}
                                        </option>
                                    @endforeach
                                    {{-- <option value="Artikel" {{ $halaman->bawah_tengah == 'Artikel' ? 'selected' : '' }}>
                                        Artikel
                                    </option> --}}

                                </select>
                                @error('bawah_tengah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col">
                            <label>Bawah Kanan</label>
                            <div class="input-group ">

                                <select name="bawah_kanan" required
                                    class="form-control form-control
                                theSelect"
                                    @error('bawah_kanan') is-invalid @enderror>
                                    <option value="Tidak" {{ $halaman->bawah_kanan == 'Tidak' ? 'selected' : '' }}>Tidak
                                        Ditampilkan</option>
                                    <option value="Slide" {{ $halaman->bawah_kanan == 'Slide' ? 'selected' : '' }}>Slide
                                    </option>
                                    <option value="Galeri" {{ $halaman->bawah_kanan == 'Galeri' ? 'selected' : '' }}>
                                        Galeri
                                    </option>

                                    <option value="Kontak" {{ $halaman->bawah_kanan == 'Kontak' ? 'selected' : '' }}>
                                        Kontak
                                    </option>
                                    {{-- <option value="Artikel" {{ $halaman->bawah_kanan == 'Artikel' ? 'selected' : '' }}>
                                        Artikel
                                    </option> --}}

                                </select>
                                @error('bawah_kanan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
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
