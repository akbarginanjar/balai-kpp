@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#keuntungan').DataTable();
        });
    </script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Keuntungan </h4>
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
                    <a href="">Keuntungan</a>
                </li>
            </ul>

        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="card-title">Keuntungan</div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('keuntungan.update', $keuntungan->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Gambar</label>
                        <div class="custom-file mb-3">
                            <input type="file" id="file" name="gambar"
                                class="custom-file-input @error('gambar') is-invalid @enderror" accept="image/*"
                                onchange="tampilkanPreview(this,'preview')" id="customFile">
                            @error('gambar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label class="custom-file-label" for="customFile">Choose
                                file</label>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a href="{{ $keuntungan->gambar() }}" data-caption="gambar" data-fancybox="gallery">
                                    <img src="{{ $keuntungan->gambar ? $keuntungan->gambar() : 'no_image' }}"
                                        class="rounded img-fluid" width="120px" alt=""></a>
                            </div>
                            <div class="col">
                                <center>
                                    <span id="panah"></span>
                                </center>
                            </div>
                            <div class="col">
                                <img id="preview" src="" alt="" class="rounded img-fluid float-right" />
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label>Teks 1</label>
                        <div class="input-group ">
                            <input type="text" value="{{ $keuntungan->teks1 }}" placeholder="Masukkan teks1"
                                name="teks1" autocomplete='off' class="form-control @error('teks1') is-invalid @enderror">
                            @error('teks1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Teks 2</label>
                        <div class="input-group ">
                            <input type="text" value="{{ $keuntungan->teks2 }}" placeholder="Masukkan teks2"
                                name="teks2" autocomplete='off' class="form-control @error('teks2') is-invalid @enderror">
                            @error('teks2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Teks 3</label>
                        <div class="input-group ">
                            <input type="text" value="{{ $keuntungan->teks3 }}" placeholder="Masukkan teks3"
                                name="teks3" autocomplete='off' class="form-control @error('teks3') is-invalid @enderror">
                            @error('teks3')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Teks 4</label>
                        <div class="input-group ">
                            <input type="text" value="{{ $keuntungan->teks4 }}" placeholder="Masukkan teks4"
                                name="teks4" autocomplete='off' class="form-control @error('teks4') is-invalid @enderror">
                            @error('teks4')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Teks 5</label>
                        <div class="input-group ">
                            <input type="text" value="{{ $keuntungan->teks5 }}" placeholder="Masukkan teks5"
                                name="teks5" autocomplete='off'
                                class="form-control @error('teks5') is-invalid @enderror">
                            @error('teks5')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Teks 6</label>
                        <div class="input-group ">
                            <input type="text" value="{{ $keuntungan->teks6 }}" placeholder="Masukkan teks6"
                                name="teks6" autocomplete='off'
                                class="form-control @error('teks6') is-invalid @enderror">
                            @error('teks6')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    </div>

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    <script>
        function tampilkanPreview(gambar, idpreview) {
            var gb = gambar.files;
            for (var i = 0; i < gb.length; i++) {
                var gbPreview = gb[i];
                var imageType = /image.*/;
                var preview = document.getElementById(idpreview);
                var reader = new FileReader();

                if (gbPreview.type.match(imageType)) {
                    preview.file = gbPreview;
                    reader.onload = (function(element) {
                        return function(e) {
                            element.src = e.target.result;
                        };
                    })(preview);
                    document.getElementById("panah").innerHTML =
                        "<br><img src='{{ asset('images/arrow.png') }}' width='90'>";
                    reader.readAsDataURL(gbPreview);
                } else {
                    alert("file yang anda upload tidak sesuai. Khusus mengunakan image.");
                }

            }
        }
    </script>
@endsection
