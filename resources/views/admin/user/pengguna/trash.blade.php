@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#pengguna').DataTable();
        });
    </script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Pengguna</h4>
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
                    <a href="/master-admin/pengguna">Pengguna</a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="">Data pengguna yang dihapus</a>
                </li>
            </ul>

        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="card-title"> Data Pengguna Yang Dihapus</div>
                    </div>
                    <div class="col">
                        {{-- <a class="btn btn-primary text-white float-right" data-toggle="modal" data-target="#tambah"
                            href="#">Tambah
                            Pengguna</a> --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table responsive-3" id="pengguna">
                        <thead>
                            <tr>
                                <th class="column-primary" data-header="User"><span>No</span></th>
                                <th>Nama Lengkap</th>
                                <th>Email / Username</th>
                                <th>No. Telepon</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($pengguna as $item)
                                <tr>
                                    <td data-header="No">{{ $no++ }}</td>
                                    <td data-header="Nama"> {{ $item->user->name }} </td>
                                    <td data-header="Email">{{ $item->user->email }}</td>
                                    <td data-header="No. Telepon">{{ $item->no_telepon }}</td>
                                    <td>
                                        @if ($item->isActive == 1)
                                            <form action="{{ $item->id }}/unonaktif" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Aktif</button>
                                            </form>
                                        @else
                                            <form action="{{ $item->id }}/uaktif" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Tidak Aktif</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/master-admin/pengguna/restore/{{ $item->id }}"
                                            class="btn btn-info btn-sm">Restore</a>
                                        <a href="/master-admin/pengguna/hapus_permanen/{{ $item->id }}"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus permanen?')">Hapus
                                            Permanen</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
