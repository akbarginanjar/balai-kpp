@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#halaman').DataTable();
        });
    </script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection

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
                    <a href="">Data Halaman</a>
                </li>
            </ul>

        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="card-title"> Data Halaman</div>
                    </div>
                    <div class="col">
                        <a class="btn btn-primary text-white float-right" href="{{ route('halaman.create') }}">Tambah
                            Halaman</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table responsive-3 table-hover" id="halaman">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($halaman as $item)
                                <tr>
                                    <td data-header="No">{{ $no++ }}</td>
                                    <td data-header="Judul"> {{ $item->judul }} </td>
                                    <td data-header="gambar">
                                        @if ($item->gambar == '' || $item->gambar == null)
                                            <span>&nbsp;&nbsp;&nbsp;&nbsp;Tidak ada foto</span>
                                        @else
                                            <a href="{{ $item->gambar() }}" data-caption="{{ $item->judul }}"
                                                data-fancybox="gallery"><img src="{{ $item->gambar() }}" alt=""
                                                    class="m-2 rounded" style="width: 110px; height: 70px;" alt="gambar">
                                        @endif
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('halaman.destroy', $item->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <a href="{{ route('halaman.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning text-white" data-toggle="tooltip"
                                                data-placement="top" title="Edit"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            <button type="submit" class="btn btn-danger btn-sm delete-confirm"
                                                data-toggle="tooltip" data-placement="top" title="Hapus"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg border-0" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSayaLabel">Tambah Data halaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('halaman.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Judul</label>
                            <div class="input-group ">
                                <input type="text" value="{{ old('judul') }}" placeholder="Masukkan Judul halaman"
                                    name="judul" autocomplete='off'
                                    class="form-control @error('judul') is-invalid @enderror" required>
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
                                cols="30" rows="8">{{ old('teks') }}</textarea>
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
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <img id="preview" src="" alt="" class="rounded img-fluid" />
                            @error('gambar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="">Atas</label>
                                </div>
                                <div class="col">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="atas" value="Tidak"
                                                class="selectgroup-input" checked="">
                                            <span class="selectgroup-button">Tidak ditampilkan</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="atas" value="Slide"
                                                class="selectgroup-input">
                                            <span class="selectgroup-button">Slide</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="atas" value="Galeri"
                                                class="selectgroup-input">
                                            <span class="selectgroup-button">Galeri</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="atas" value="Peta"
                                                class="selectgroup-input">
                                            <span class="selectgroup-button">Peta</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="">Tengah</label>
                                </div>
                                <div class="col">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="tengah" value="Tidak"
                                                class="selectgroup-input" checked="">
                                            <span class="selectgroup-button">Tidak ditampilkan</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="tengah" value="Slide"
                                                class="selectgroup-input">
                                            <span class="selectgroup-button">Slide</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="tengah" value="Galeri"
                                                class="selectgroup-input">
                                            <span class="selectgroup-button">Galeri</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="tengah" value="Peta"
                                                class="selectgroup-input">
                                            <span class="selectgroup-button">Peta</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="">Bawah</label>
                                </div>
                                <div class="col">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="bawah" value="Tidak"
                                                class="selectgroup-input" checked="">
                                            <span class="selectgroup-button">Tidak ditampilkan</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="bawah" value="Slide"
                                                class="selectgroup-input">
                                            <span class="selectgroup-button">Slide</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="bawah" value="Galeri"
                                                class="selectgroup-input">
                                            <span class="selectgroup-button">Galeri</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="bawah" value="Peta"
                                                class="selectgroup-input">
                                            <span class="selectgroup-button">Peta</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary text-white">Simpan</button>
                </div>
                </form>
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
                    reader.readAsDataURL(gbPreview);
                } else {
                    alert("file yang anda upload tidak sesuai. Khusus mengunakan image.");
                }

            }
        }
    </script>
@endsection
