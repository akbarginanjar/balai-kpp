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
            <h4 class="page-title">Kalender Kegiatan</h4>
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
                    <a href="">Kalender Kegiatan</a>
                </li>
            </ul>

        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="card-title"> Tambah Kalender Kegiatan</div>
                    </div>
                    <div class="col">
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('kalender-kegiatan.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for=""> Nama Kegitan</label>
                        <input type="text" name="nama_kegiatan" required class="form-control"
                            placeholder="Masukan Nama Kegiatan" name="" id="">
                    </div>
                    <div class="form-group">
                        <label for=""> Tanggal Kegiatan</label>
                        <input type="datetime-local" name="waktu_kegiatan" required class="form-control"
                            placeholder="Masukan Nama Kegiatan" name="" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Dokumentasi</label>
                        <input type="file" name="dokumentasi" required class="form-control"
                            placeholder="upload Image"  id="">
                    </div>
                    <div class="form-group">
                        <label for=""> Deskripsi</label>
                        <textarea name="deskripsi" id="" class="form-control" required cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
