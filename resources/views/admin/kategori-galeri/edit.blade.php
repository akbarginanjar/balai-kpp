@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Menu</h4>
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
                    <a href="/admin/menu">Menu</a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="">Edit Menu</a>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="cerd-header">
                <h4 class="card-title col-sm-10">Data Edit Mekanisme Bayar</h4>
            </div>
            <div class="card-body" <form action=" {{ route('mekanisme-bayar.update', $jenisBayar->id) }} " method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Mekanis Bayar</label>
                    <div class="input-group ">
                        <input type="text" value="{{ $jenisBayar->nama }}" name="nama" autocomplete='off'
                            class="form-control form-control-sm @error('nama') is-invalid @enderror">
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Persentase</label>
                    <div class="input-group ">
                        <input type="number" step="any" value="{{ $jenisBayar->persentase }}"
                            placeholder="Masukkan Persentase" name="persentase" autocomplete='off'
                            class="form-control form-control-sm @error('persentase') is-invalid @enderror">
                        @error('persentase')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-warning text-white"><i class="fa fa-save mr-1"></i>
                        Simpan Perubahan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
