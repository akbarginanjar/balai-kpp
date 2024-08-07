@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#submenu').DataTable();
        });
    </script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection

@section('ckeditor')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#ckeditor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Sub Menu</h4>
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
                    <a href="/master-admin/menu">Menu</a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="">Data Sub Menu</a>
                </li>
            </ul>

        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-10">
                        <div class="card-title mb-2">Data Sub Menu {{ $menu->nama }}</div>
                        <a class="btn btn-primary text-white" href="submenu/create">Tambah
                            SubMenu</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table responsive-3" id="submenu">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Konten</th>
                                <th>Aksi</th>
                                <th>Urutan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($submenu as $item)
                                <tr>
                                    <td data-header="No">{{ $no++ }}</td>
                                    <td data-header="Nama SubMenu">{{ $item->nama }}</td>
                                    <td data-header="Isi Konten">
                                        @if ($item->konten->id_halaman != null)
                                            {{ $item->konten->halaman->judul }}
                                        @elseif ($item->konten->id_artikel != null)
                                            {{ $item->konten->artikel->judul }}
                                        @elseif ($item->konten->id_kegiatan != null)
                                            {{ $item->konten->kegiatan->judul }}
                                        @elseif ($item->konten->link != null)
                                            <a href="{{ $item->konten->link->link }}">{{ $item->konten->link->nama }}</a>
                                        @elseif ($item->konten->id_kategori_artikel != null)
                                            {{ $item->konten->kategoriArtikel->slug }}
                                        @else
                                            <span class="text-danger"> Kosong</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="submenu/{{ $item->id }}/destroy" method="post">
                                            @csrf
                                            <a href="submenu/{{ $item->id }}/edit"
                                                class="btn btn-sm btn-warning text-white" data-toggle="tooltip"
                                                data-placement="top" title="Edit"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            <button type="submit" class="btn btn-danger btn-sm delete-confirm"
                                                data-toggle="tooltip" data-placement="top" title="Hapus"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="submenu/urutan/{{ $item->id }}/atas" method="post">
                                            @csrf
                                            @if ($item->urutan != 1)
                                                <button type="submit" class="btn btn-primary btn-sm"><i
                                                        class="fa-solid fa-arrow-up"></i></button>
                                            @endif
                                        </form>
                                        <form action="submenu/urutan/{{ $item->id }}/bawah" method="post">
                                            @csrf
                                            @if ($item->urutan != $submenuCount)
                                                <button type="submit" class="btn btn-info btn-sm"><i
                                                        class="fa-solid fa-arrow-down"></i></button>
                                            @endif
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
                    <h5 class="modal-title" id="modalSayaLabel">Tambah Data Sub Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="submenu/create" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nama SubMenu</label>
                            <div class="input-group ">
                                <input type="text" value="{{ old('nama') }}" placeholder="Masukkan Nama SubMenu"
                                    name="nama" autocomplete='off'
                                    class="form-control @error('nama') is-invalid @enderror" required>
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Menu</label>
                            <div class="input-group ">
                                <select name="id_menu" required class="form-control" @error('id_menu') is-invalid @enderror>
                                    <option value="">-- Pilih Menu --</option>
                                    @foreach ($menu as $item)
                                        @if ($item->id_konten === 0)
                                            <option value="{{ $item->id }}">
                                                {{ $item->nama }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_menu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Isi Konten</label>
                            <div class="input-group ">

                                <select name="id_konten" required class="form-control"
                                    @error('id_konten') is-invalid @enderror>
                                    <option value="">-- Pilih Isi Konten --</option>
                                    @foreach ($konten as $item)
                                        @if ($item->id_halaman != null)
                                            <option value="{{ $item->id }}">
                                                {{ $item->halaman->judul }} | {{ $item->type }}
                                            </option>
                                        @elseif ($item->id_artikel != null)
                                            <option value="{{ $item->id }}">
                                                {{ $item->artikel->judul }} | {{ $item->type }}
                                            </option>
                                        @elseif ($item->id_kegiatan != null)
                                            <option value="{{ $item->id }}">
                                                {{ $item->kegiatan->judul }} | {{ $item->type }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_konten')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
@endsection
