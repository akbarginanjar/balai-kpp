@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script>
        $(document).ready(function() {
            $('#kategoriArtikel').DataTable();
        });
    </script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Kategori Lelang</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="/admin/dashboard">
                        <i class="fa-solid fa-house-chimney"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="/admin/lelang">Lelang</a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="">Kategori Lelang</a>
                </li>
            </ul>

        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="card-title"> Data Kategori Lelang</div>
                    </div>
                    <div class="col">
                        <a href="{{route('lelang.create')}}" class="btn btn-primary">Tambah Data Lelang</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table responsive-3" id="kategoriArtikel">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama </th>
                                <th>Harga</th>
                                {{-- <th>Deskripsi</th> --}}
                                {{-- <th>Alamat</th> --}}
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                         <tbody>
                            @php
                                $no = 1;
                            @endphp
                           @foreach ($lelang as $item)
                           <tr>
                               <td>{{$no++}}</td>
                               <td>{{$item->nama}}</td>
                               <td>{{$item->harga}}</td>
                               {{-- <td>{!! $item->deskripsi !!}</td>
                               <td>{{$item->alamat}}</td> --}}
                               <td><img src="{{asset('images/lelang/' . $item->gambar)}}" width="50%" height="50%"  class="rounded mx-auto d-block" ></td>
                               <td>
                                   <form action="{{route('lelang.destroy', $item->id)}}" method="post">
                                     @csrf
                                     @method('delete')
                                     <a href="{{route('lelang.show' , $item->id)}}" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat"><i class="bi bi-eye-fill"></i></a>
                                    <a href="{{route('lelang.edit' , $item->id)}}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                    <button type="submit" class="btn btn-danger btn-sm delete-confirm"><i
                                        class="fa-solid fa-trash" data-toggle="tooltip" data-placement="top"
                                        title="Hapus"></i></button>  
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
