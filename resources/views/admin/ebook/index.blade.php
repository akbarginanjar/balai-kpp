@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#ebook').DataTable();
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
                @if (Auth::user()->id == 1)
                    <li class="nav-item">
                        <a href="/master-admin/module">Module</a>
                    </li>
                    <li class="separator">
                        <i class="fa-solid fa-chevron-right"></i>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="">E-book</a>
                </li>
            </ul>

        </div>
        <div class="card">
            <div class="card-header">
                <div class="row ">
                    <div class="col-sm-7">
                        <div class="card-title"> Data E-book</div>
                    </div>
                    <div class="col mt-3">
                        <a class="btn btn-secondary text-white float-right" href="/master-admin/kategori-ebook">
                            Kategori E-book</a>
                    </div>
                    <div class="col mt-3">
                        <a class="btn btn-primary text-white float-right" href="{{ route('ebook.create') }}">Tambah
                            E-book</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table responsive-3 table-hover" id="ebook">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori E-book</th>
                                <th>Gambar</th>
                                {{-- <th></th> --}}
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($ebook as $item)
                                {{-- @if (Auth::user()->id == 1 || $item->user->id == Auth::user()->id) --}}
                                <tr>
                                    <td data-header="No">{{ $no++ }}</td>
                                    <td data-header="Judul"> {{ $item->judul }}</td>
                                    <td data-header="Kategori E-book"> {{ $item->kategoriEbook->nama }} </td>
                                    <td data-header="gambar"><a href="{{ $item->gambar() }}"
                                            data-caption="{{ $item->judul }}" data-fancybox="gallery"> <img
                                                src="{{ $item->gambar() }}" class="m-2 rounded"
                                                style="width: 110px; height: 70px;" alt="gambar">
                                        </a>
                                    </td>
                                    {{-- <td>
                                            <a href="/master-admin/comment/{{ $item->id }}" class="btn btn-info">Lihat
                                                Komentar</a>
                                        </td> --}}
                                    <td>
                                        <form action="{{ route('ebook.destroy', $item->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <a href="{{ route('ebook.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning text-white" data-toggle="tooltip"
                                                data-placement="top" title="Edit"><i
                                                    class="fa-solid fa-pen-to-square"></i> </a>
                                            <button type="submit" class="btn btn-danger btn-sm delete-confirm"
                                                data-toggle="tooltip" data-placement="top" title="Hapus"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                {{-- @endif --}}
                            @endforeach
                        </tbody>
                    </table>

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
                    reader.readAsDataURL(gbPreview);
                } else {
                    alert("file yang anda upload tidak sesuai. Khusus mengunakan image.");
                }

            }
        }
    </script>
@endsection
