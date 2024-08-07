@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
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
            <h4 class="page-title">Urutan Menu</h4>
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
                    <a href="/admin/urutan">Urutan Menu</a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="">Data Urutan Menu</a>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-10">
                        <div class="card-title">Data Urutan Menu</div>
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
                                <th>Urutan</th>
                                <th>Aksi</th>
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
                                    <td data-header="Urutan">{{ $item->urutan ? $item->urutan : 'Tidak ada urutan' }}</td>
                                    <td>
                                        {{-- <a class="btn btn-sm btn-warning text-white" data-toggle="modal"
                                            data-id="{{ $item->id }}" data-target="#edit{{ $item->id }}"
                                            data-toggle="tooltip" data-placement="top" title="Edit" href="#"><i
                                                class="fa-solid fa-arrow-up-1-9"></i></a> --}}
                                        <form action="/admin/urutan/{{ $item->id }}/atas" method="post">
                                            @csrf
                                            @if ($item->urutan != 1)
                                                <button type="submit" class="btn btn-primary btn-sm mb-1 mt-1"><i
                                                        class="fa-solid fa-arrow-up"></i></button>
                                            @endif
                                        </form>
                                        <form action="/admin/urutan/{{ $item->id }}/bawah" method="post">
                                            @csrf
                                            @if ($item->urutan != $menuCount)
                                                <button type="submit" class="btn btn-info btn-sm mb-1"><i
                                                        class="fa-solid fa-arrow-down"></i></button>
                                            @endif
                                        </form>
                                    </td>

                                </tr>
                                <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modalSayaLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg border-0" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalSayaLabel">Urutan Menu</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="urutan/{{ $item->id }}/proses" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Nama Menu</label>
                                                        <div class="input-group ">
                                                            <input type="text" value="{{ $item->nama }}"
                                                                autocomplete='off'
                                                                class="form-control @error('nama') is-invalid @enderror"
                                                                readonly>
                                                            @error('nama')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Urutan</label>
                                                        <div class="input-group ">
                                                            <input type="number" name="urutan"
                                                                value="{{ $item->urutan }}" autocomplete='off'
                                                                class="form-control @error('urutan') is-invalid @enderror"
                                                                required>
                                                            @error('urutan')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
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
@endsection
