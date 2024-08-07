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
                    <a href="">Data pengguna</a>
                </li>
            </ul>

        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="card-title"> Data Pengguna</div>
                    </div>
                    <div class="col">
                        <a class="btn btn-primary text-white float-right" data-toggle="modal" style="float: right;"
                            data-target="#tambah" href="#">Tambah
                            Pengguna</a>
                        <a href="/master-admin/pengguna_trash" class=" btn btn-info text-white"
                            style="float: right; margin-right: 20px;">Data
                            yang
                            dihapus</a>
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
                                        <form action="{{ route('pengguna.destroy', $item->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            @if (Auth::user()->id == 1 || $item->user->id == Auth::user()->id)
                                                <a class="btn btn-sm btn-warning text-white" data-toggle="modal"
                                                    data-id="{{ $item->id }}" data-target="#edit{{ $item->id }}"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"
                                                    href="#"><i class="fa-solid fa-pen-to-square"></i></a>
                                            @endif
                                            <a href="{{ route('pengguna.show', $item->id) }}" data-toggle="tooltip"
                                                data-placement="top" title="Lihat" class="btn btn-info btn-sm"><i
                                                    class="fa-regular fa-eye"></i></a>
                                            <button type="submit" class="btn btn-danger btn-sm delete-confirm"
                                                data-toggle="tooltip" data-placement="top" title="Hapus"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modalSayaLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg border-0" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header ">
                                                <h5 class="modal-title" id="modalSayaLabel">Edit Data Pengguna</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('pengguna.update', $item->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="name" class="label">Nama Lengkap</label>
                                                        <input id="name" type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            name="name" value="{{ $item->user->name }}"
                                                            placeholder="Masukan nama lengkap" autocomplete="name"
                                                            autofocus>

                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email" class="label">Alamat Email</label>
                                                        <input id="email" type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" value="{{ $item->user->email }}"
                                                            placeholder="Masukan alamat email" autocomplete="email">

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password" class="label">{{ __('Password') }}
                                                            Baru</label>
                                                        <input id="password" type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            name="password" placeholder="Masukan password baru"
                                                            autocomplete="new-password">
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="konfirmasi">Konfirmasi Password</label>
                                                        <input type="password" name="password_confirmation"
                                                            autocomplete="off"
                                                            class="form-control @error('password_confirmation') is-invalid @enderror">
                                                        @error('password_confirmation')
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
                    <h5 class="modal-title" id="modalSayaLabel">Tambah Data pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pengguna.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="label">Nama Lengkap</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" placeholder="Masukan nama lengkap"
                                autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="label">Alamat Email</label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" placeholder="Masukan alamat email" autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="label">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="Masukan password" autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="konfirmasi">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" autocomplete="off"
                                class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
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
@endsection
