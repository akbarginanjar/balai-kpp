@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('ckeditor')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('ckeditor', {
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#tentangkami').DataTable();
        });
    </script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Tentang Kami</h4>
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
                    <a href="">Tentang Kami</a>
                </li>
            </ul>

        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="card-title"> Data Judul</div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="/master-admin/tentangkami/ubah" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="form-group">
                        <label>Icon</label>
                        <div class="custom-file mb-3">
                            <input type="file" id="file" name="icon"
                                class="custom-file-input @error('icon') is-invalid @enderror"
                                accept="image/*" onchange="tampilkanPreview(this,'preview')"
                                id="customFile">
                            <label class="custom-file-label" for="customFile">Choose
                                file</label>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a href="{{ $setting->icon() }}" data-caption="Icon"
                                    data-fancybox="gallery">
                                    <img src="{{ $setting->icon ? $setting->icon() : 'no_image' }}"
                                        class="rounded img-fluid" width="120px" alt=""></a>
                            </div>
                            <div class="col">
                                <center>
                                    <span id="panah"></span>
                                </center>
                            </div>
                            <div class="col">
                                <img id="preview" src="" alt=""
                                    class="rounded img-fluid float-right" />
                            </div>
                        </div>
                        @error('icon')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}
                    <div class="form-group">
                        <label>Judul</label>
                        <div class="input-group ">
                            <input type="text" value="{{ $tentangkami->judul }}" placeholder="Masukkan judul"
                                name="judul" autocomplete='off' class="form-control @error('judul') is-invalid @enderror">
                            @error('judul')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Isi</label>
                        <div class="input-group ">
                            <textarea name="isi" id="ckeditor" value="{{ $tentangkami->isi }}" autocomplete='off'
                                class="form-control @error('isi') is-invalid @enderror" cols="30" rows="8">{{ $tentangkami->isi }}</textarea>
                            @error('isi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
