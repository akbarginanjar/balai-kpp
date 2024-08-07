@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Form Mekanisme Bayar</h4>
            <p class="card-description">
                Basic form elements
            </p>
            <form action=" {{ route('mekanisme-bayar.store') }} " method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nama Mekanisme Bayar</label>
                    <div class="input-group ">
                        <input type="text" placeholder="Masukkan Nama Mekanisme Bayar" name="nama" autocomplete='off'
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
                        <input type="number" step="any" placeholder="Masukkan Persentase" name="persentase"
                            autocomplete='off'
                            class="form-control form-control-sm @error('persentase') is-invalid @enderror">
                        @error('persentase')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>
                        Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
