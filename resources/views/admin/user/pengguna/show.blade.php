@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Pengguna</h4>
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
                    <a href="/admin/pengguna">Pengguna</a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="">Lihat Pengguna</a>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Lihat Data Pengguna</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" value="{{ $user->user->name }}" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <input type="text" value="{{ $user->jenis_kelamin }}" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Agama</label>
                    <input type="text" value="{{ $user->agama }}" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" value="{{ $user->no_telepon }}" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" value="{{ $user->user->email }}" class="form-control" disabled>
                </div>
            </div>
        </div>
    </div>
@endsection
