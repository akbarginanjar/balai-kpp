@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#galeri').DataTable();
        });
    </script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Galeri</h4>
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
                    <a href="">Galeri</a>
                </li>
            </ul>

        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="card-title"> Data galeri</div>
                    </div>
                    <div class="col">
                        <a class="btn btn-info text-white float-right" href="/master-admin/kategori-galeri">Kategori
                            Galeri</a>
                    </div>
                    <div class="col">
                        <a class="btn btn-primary text-white float-right" data-toggle="modal" data-target="#tambah"
                            href="#">Tambah
                            Galeri</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table responsive-3" id="galeri">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($galeri as $item)
                                <tr>
                                    <td data-header="No">{{ $no++ }}</td>
                                    <td data-header="Kategori"> {{ $item->kategori_galeri->nama }} </td>
                                    <td data-header="Gambar"><a href="{{ $item->gambar() }}"
                                            data-caption="{{ $item->kategori_galeri->nama }}" data-fancybox="gallery"> <img
                                                src="{{ $item->gambar() }}" alt="" class="m-2 rounded"
                                                style="width: 110px; height: 70px;" alt="gambar"> </td>
                                    </a>
                                    <td>
                                        <form action="{{ route('galeri.destroy', $item->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <a class="btn btn-sm btn-warning text-white" data-toggle="modal"
                                                data-id="{{ $item->id }}" data-target="#edit{{ $item->id }}"
                                                data-toggle="tooltip" data-placement="top" title="Edit" href="#"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            <button type="submit" class="btn btn-danger btn-sm delete-confirm"><i
                                                    class="fa-solid fa-trash" data-toggle="tooltip" data-placement="top"
                                                    title="Hapus"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modalSayaLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg border-0" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header ">
                                                <h5 class="modal-title" id="modalSayaLabel">Edit Data galeri</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('galeri.update', $item->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label>Kategori galeri</label>
                                                        <div class="input-group ">

                                                            <select name="id_kategori_galeri" required class="form-control"
                                                                @error('id_kategori_galeri') is-invalid @enderror>
                                                                <option value="">-- Pilih Kategori Galeri --</option>
                                                                @foreach ($kategoriGaleri as $data)
                                                                    <option value="{{ $data->id }}"
                                                                        {{ $data->id == $item->id_kategori_galeri ? 'selected' : '' }}>
                                                                        {{ $data->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('id_kategori_galeri')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Upload File Gambar</label>
                                                        <div class="custom-file mb-3">
                                                            <input type="file" id="file" name="gambar"
                                                                class="custom-file-input @error('gambar') is-invalid @enderror"
                                                                accept="image/*" onchange="tampilkanEdit(this,'pedit')"
                                                                id="customFile">
                                                            <label class="custom-file-label" for="customFile">Choose
                                                                file</label>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <img src="{{ $item->gambar() }}"
                                                                    class="rounded img-fluid" alt="">
                                                            </div>
                                                            <div class="col">
                                                                <center>
                                                                    <span id="edit"></span>
                                                                </center>
                                                            </div>
                                                            <div class="col">
                                                                <img id="pedit" src="" alt=""
                                                                    class="rounded img-fluid float-right" />
                                                            </div>
                                                        </div>
                                                        @error('gambar')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-dark"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-warning text-white">Simpan
                                                    Perubahan</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                <div class="modal-header ">
                    <h5 class="modal-title" id="modalSayaLabel">Tambah Data galeri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Kategori galeri</label>
                            <div class="input-group ">

                                <select name="id_kategori_galeri" required class="form-control"
                                    @error('id_kategori_galeri') is-invalid @enderror>
                                    <option value="">-- Pilih Kategori Galeri --</option>
                                    @foreach ($kategoriGaleri as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_kategori_galeri')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Upload File Gambar</label>
                            <div class="custom-file mb-3">
                                <input type="file" id="file" name="gambar[]"
                                    class="custom-file-input @error('gambar') is-invalid @enderror" accept="image/*"
                                    onchange="tampilkanTambah(this,'ptambah')" id="customFile" multiple>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <img id="ptambah" src="" alt="" class="img-fluid rounded" />
                            @error('gambar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
        function tampilkanEdit(gambar, idpreview) {
            var gb = gambar.files;
            for (var i = 0; i < gb.length; i++) {
                var gbPreview = gb[i];
                var imageType = /image.*/;
                var pedit = document.getElementById(idpreview);
                var reader = new FileReader();

                if (gbPreview.type.match(imageType)) {
                    pedit.filePedit = gbPreview;
                    reader.onload = (function(element) {
                        return function(e) {
                            element.src = e.target.result;
                        };
                    })(pedit);
                    document.getElementById("edit").innerHTML = "<img src='{{ asset('images/arrow.png') }}' width='80'>";
                    reader.readAsDataURL(gbPreview);
                } else {
                    alert("file yang anda upload tidak sesuai. Khusus mengunakan image.");
                }

            }
        }

        function tampilkanTambah(gambar, idpreview) {
            var gb = gambar.files;
            for (var i = 0; i < gb.length; i++) {
                var gbPreview = gb[i];
                var imageType = /image.*/;
                var ptambah = document.getElementById(idpreview);
                var reader = new FileReader();

                if (gbPreview.type.match(imageType)) {
                    ptambah.fileTambah = gbPreview;
                    reader.onload = (function(element) {
                        return function(e) {
                            element.src = e.target.result;
                        };
                    })(ptambah);
                    reader.readAsDataURL(gbPreview);
                } else {
                    alert("file yang anda upload tidak sesuai. Khusus mengunakan image.");
                }

            }
        }
    </script>
@endsection
