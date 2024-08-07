@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#menu').DataTable();
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
            <h4 class="page-title">Menu</h4>
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
                    <a href="">Data Menu</a>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-10">
                        <div class="card-title">Data Menu</div>
                    </div>
                    <div class="col">
                        <a class="btn btn-primary text-white float-right" href="{{ route('menu.create') }}">Tambah
                            Menu</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table responsive-3" id="menu">
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
                            @foreach ($menu as $item)
                                <tr>
                                    <td data-header="No">{{ $no++ }}</td>
                                    <td data-header="Nama Menu">{{ $item->nama }}</td>
                                    <td data-header="Isi Konten">
                                        @if ($item->id_konten != 0)
                                            @if ($item->konten->id_halaman != null)
                                                {{ $item->konten->halaman->judul }}
                                            @elseif ($item->konten->id_artikel != null)
                                                {{ $item->konten->artikel->judul }}
                                            @elseif ($item->konten->id_kegiatan != null)
                                                {{ $item->konten->kegiatan->judul }}
                                            @elseif ($item->konten->link != null)
                                                <a
                                                    href="{{ $item->konten->link->link }}">{{ $item->konten->link->nama }}</a>
                                            @else
                                                <span class="text-danger"> Kosong</span>
                                            @endif
                                        @else
                                            #
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('menu.destroy', $item->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            @if ($item->id_konten == 0)
                                                <a href="/master-admin/menu/{{ $item->slug }}/submenu"
                                                    class="btn btn-sm btn-success text-white" data-toggle="tooltip"
                                                    data-placement="top" title="SubMenu"><i
                                                        class="fa-solid fa-list"></i></a>
                                            @endif
                                            <a href="{{ route('menu.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning text-white" data-toggle="tooltip"
                                                data-placement="top" title="Edit"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            <button type="submit" class="btn btn-danger btn-sm delete-confirm"
                                                data-toggle="tooltip" data-placement="top" title="Hapus"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="/master-admin/urutan/{{ $item->id }}/atas" method="post">
                                            @csrf
                                            @if ($item->urutan != 1)
                                                <button type="submit" class="btn btn-primary btn-sm"><i
                                                        class="fa-solid fa-arrow-up"></i></button>
                                            @endif
                                        </form>
                                        <form action="/master-admin/urutan/{{ $item->id }}/bawah" method="post">
                                            @csrf
                                            @if ($item->urutan != $menuCount)
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
                    <h5 class="modal-title" id="modalSayaLabel">Tambah Data menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nama Menu</label>
                            <div class="input-group ">
                                <input type="text" value="{{ old('nama') }}" placeholder="Masukkan Nama menu"
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
                            <label>Isi Konten</label>
                            <div class="input-group ">
                                <select name="id_konten" required class="form-control"
                                    @error('id_konten') is-invalid @enderror>
                                    <option value="">-- Pilih Isi Konten --</option>
                                    <option value="#">Sub Menu</option>
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
                            <h2>Membuat Search di Select Option</h2>
                            <select class="theSelect">
                                <option value="Codeigniter">Codeigniter</option>
                                <option value="FuelPHP">FuelPHP</option>
                                <option value="PhalconPHP">PhalconPHP</option>
                                <option value="Slim">Slim</option>
                                <option value="Silex">Silex</option>
                                <option value="CakePHP">CakePHP</option>
                                <option value="Symfony">Symfony</option>
                                <option value="Yii">Yii</option>
                                <option value="Laravel">Laravel</option>
                                <option value="Lumen">Lumen</option>
                                <option value="Zend">Zend</option>
                            </select>
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
