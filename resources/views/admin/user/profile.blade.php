@extends('layouts.admin')

@section('content')
    <div class="panel-header bg-dark-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h1 class="text-white pb-2 fw-bold">PROFILE</h1>
                </div>
                <div class="ml-md-auto py-2 py-md-0">
                    <a class="btn btn-warning mr-2" data-toggle="modal" data-target="#edit" href="#">Edit Profile</a>
                    <a class="btn btn-info text-white" data-toggle="modal" data-target="#editA" href="#">Edit Akun</a>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-sm-7">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <h3>Data Profile</h3>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" value="{{ $pengguna->user->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="text" class="form-control"
                                value="{{ date('d-m-Y', strtotime($pengguna->tgl_lahir)) }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <input type="text" class="form-control" value="{{ $pengguna->jenis_kelamin }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Agama</label>
                            <input type="text" class="form-control" value="{{ $pengguna->agama }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <h3>Data Akun</h3>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" value="{{ $pengguna->user->email }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="text" class="form-control" value="{{ $pengguna->no_telepon }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg border-0" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title" id="modalSayaLabel">Edit Data pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/admin/profile/{{ $pengguna->id }}/edit" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="label">Nama Lengkap</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ $pengguna->user->name }}" placeholder="Masukan Nama Lengkap"
                                autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir" class="label">Tangggal Lahir</label>
                            <input id="tgl_lahir" type="date"
                                class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir"
                                value="{{ $pengguna->tgl_lahir }}" placeholder="Masukan Tangggal Lahir"
                                autocomplete="tgl_lahir" autofocus required>

                            @error('tgl_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="no_telepon" class="label">No Telepon</label>
                            <input id="no_telepon" type="number"
                                class="form-control @error('no_telepon') is-invalid @enderror" name="no_telepon"
                                value="{{ $pengguna->no_telepon }}" placeholder="Masukan nomor telepon"
                                autocomplete="no_telepon">

                            @error('no_telepon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jk" class="label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control"
                                @error('jenis_kelamin') is-invalid @enderror" required>
                                <option value="">--- Pilih Jenis Kelamin ---</option>
                                <option value="Laki-Laki" {{ $pengguna->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>
                                    Laki-Laki </option>
                                <option value="Perempuan" {{ $pengguna->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan </option>
                            </select>

                            @error('jenis_kelamin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="agama" class="label">Agama</label>
                            <select name="agama" class="form-control" @error('agama') is-invalid @enderror" required>
                                <option value="">--- Pilih Agama ---</option>
                                <option value="Islam" {{ $pengguna->agama == 'Islam' ? 'selected' : '' }}>
                                    Islam </option>
                                <option value="Kristen" {{ $pengguna->agama == 'Kristen' ? 'selected' : '' }}>
                                    Kristen </option>
                                <option value="Hindu" {{ $pengguna->agama == 'Hindu' ? 'selected' : '' }}>
                                    Hindu </option>
                                <option value="Budha" {{ $pengguna->agama == 'Budha' ? 'selected' : '' }}>
                                    Budha </option>
                            </select>

                            @error('agama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-warning text-white">Simpan Perubahan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editA" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg border-0" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning border-0">
                    <h5 class="modal-title" id="modalSayaLabel">Edit Data Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        <i class="fa-solid fa-triangle-exclamation mr-1"></i>
                        Isi data dibawah jika ingin mengubah Email atau Password anda.
                    </div>
                    <form action="/admin/akun/{{ $pengguna->user->id }}/edit" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Alamat Email</label>
                            <div class="input-group ">
                                <input type="text" value="{{ $pengguna->user->email }}"
                                    placeholder="Masukan alamat email" name="email" autocomplete='off'
                                    class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="label">Password Baru</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="Masukan password" autocomplete="new-password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-warning text-white">Simpan Perubahan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
