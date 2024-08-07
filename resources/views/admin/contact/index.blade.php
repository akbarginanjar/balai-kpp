@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#contact').DataTable();
        });
    </script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Kontak</h4>
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
                    <a href="">Kontak</a>
                </li>
            </ul>

        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="card-title"> Data Kontak</div>
                    </div>
                    <div class="col">
                        {{-- <a class="btn btn-primary float-right text-white" data-toggle="modal" data-target="#tambah"
                            href="#">Tambah
                            Data Artikel</a> --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table responsive-3" id="contact">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Pesan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($contact as $item)
                                <tr>
                                    <td data-header="No">{{ $no++ }}</td>
                                    <td data-header="Nama"> {{ $item->nama }} </td>
                                    <td data-header="Email"> {{ $item->email }} </td>
                                    <td data-header="Pesan"> {{ Str::limit($item->pesan, 10) }} </td>
                                    <td>
                                        <form action="{{ route('kontak.destroy', $item->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            {{-- <a href="{{ route('kategori-artikel.edit', $item->id) }}"
                                            class="btn btn-sm btn-warning text-white"><i
                                                class="fa-solid fa-pen-to-square"></i></a> --}}
                                            <a class="btn btn-sm btn-info text-white" data-toggle="modal"
                                                data-id="{{ $item->id }}" data-target="#lihat{{ $item->id }}"
                                                href="#" data-toggle="tooltip" data-placement="top" title="Lihat"><i
                                                    class="fa-solid fa-eye"></i></a>
                                            <button type="submit" class="btn btn-danger btn-sm delete-confirm"><i
                                                    class="fa-solid fa-trash" data-toggle="tooltip" data-placement="top"
                                                    title="Hapus"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="lihat{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modalSayaLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg border-0" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header ">
                                                <h5 class="modal-title" id="modalSayaLabel">Lihat Detail</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Nama Lengkap</label>
                                                    <input type="text" class="form-control" value="{{ $item->nama }}"
                                                        disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" value="{{ $item->email }}"
                                                        disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pesan</label>
                                                    <textarea class="form-control" rows="5" disabled>{{ $item->pesan }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-dark"
                                                    data-dismiss="modal">Tutup</button>
                                            </div>
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
@endsection
