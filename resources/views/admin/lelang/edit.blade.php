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
@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
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

@section('js')
    <script src="{{ asset('assets/admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>
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
            <h4 class="page-title">Edit Data Lelang</h4>
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
                    <a href="">Edit  Lelang</a>
                </li>
            </ul>

        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="card-title"> Edit Data Lelang</div>
                    </div>
                    <div class="col">
                        {{-- <a href="{{route('lelang.create')}}" class="btn btn-primary">Tambah Data Lelang</a> --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('lelang.update' , $lelang->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <label for="" class="mb-2">Masukan Nama / Judul Lelang</label>
                    <input type="text" value="{{$lelang->nama}}" name="nama" required placeholder="Masukan Nama / Judul Lelang" class="form-control mb-3">
                    <label for="" class="mb-2">Harga Lelang</label>
                    <input type="text" value="{{$lelang->harga}}" name="harga" required placeholder="Harga Lelang" class="form-control mb-3">
                    <label class="mb-2">Deskripsi</label>
                    <textarea  name="deskripsi" required id="ckeditor" autocomplete='off' class="mb-3 form-control mb-3" cols="30" rows="8">{{$lelang->deskripsi}}</textarea><br>
                    <label for="" class="mb-2">Alamat</label>
                    <textarea  id="" name="alamat" required cols="30" rows="10" placeholder="alamat" class="form-control">{{$lelang->alamat}}</textarea><br>
                    <label for="" class="mb-2">Gambar</label>
                   <div class="row">
                    <div class="col-md-10 mb-2">
                        <input id="uploadImage"  class="form-control" type="file" name="gambar" onchange="PreviewImage();" />
                    </div><div class="col">
                        <button class="btn btn-primary mb-2" style="float: right">Kirim</button>
                    </div>
                   </div><br>
                        <center> <img id="uploadPreview" src="{{asset('images/lelang/' .$lelang->gambar)}}" style="width: 80%"><br> </center>
                 </div>
                </form>
                </div>
        </div>
    </div>

    <script type="text/javascript">
        function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
        oFReader.onload = function (oFREvent)
         {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
        };
        </script>   

    <script>
        CKEDITOR.replace( 'editor1' );
    </script>

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
