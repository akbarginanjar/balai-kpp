@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#kategorigaleri').DataTable();
        });
    </script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Artikel</h4>
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
                    <a href="/master-admin/artikel">Artikel</a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="">Komentar</a>
                </li>
            </ul>

        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="card-title"> Data Komentar</div>
                    </div>
                    <div class="col">
                        {{-- <a class="btn btn-primary float-right text-white" data-toggle="modal" data-target="#tambah"
                            href="#">Tambah
                            Kategori Galeri</a> --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table responsive-3" id="kategorigaleri">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Teks</th>
                                <th>Publish</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($comment as $item)
                                <tr>
                                    <td data-header="No">{{ $no++ }}</td>
                                    <td data-header="Name"> {{ $item->name }} </td>
                                    <td data-header="Email"> {{ $item->email }} </td>
                                    <td data-header="Teks"> {{ Str::limit($item->teks, 20) }} </td>
                                    <td data-header="Publish">
                                        @if ($item->publish == 0)
                                            <form action="/master-admin/comment/{{ $item->id }}/publish" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Tidak
                                                    Publish</button>
                                            </form>
                                        @else
                                            <form action="/master-admin/comment/{{ $item->id }}/nonpublish"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Publish</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="/master-admin/comment/{{ $item->id }}/delete" method="post">
                                            @method('delete')
                                            @csrf
                                            {{-- <a href="{{ route('kategori-galeri.edit', $item->id) }}"
                                            class="btn btn-sm btn-warning text-white"><i
                                                class="fa-solid fa-pen-to-square"></i></a> --}}
                                            <a class="btn btn-sm btn-primary text-white" data-toggle="modal"
                                                data-id="{{ $item->id }}" data-target="#edit{{ $item->id }}"
                                                href="#" data-toggle="tooltip" data-placement="top"
                                                title="Reply">Reply</a>
                                            <button type="submit" class="btn btn-danger btn-sm delete-confirm"><i
                                                    class="fa-solid fa-trash" data-toggle="tooltip" data-placement="top"
                                                    title="Hapus"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modalSayaLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg border-0" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header ">
                                                <h5 class="modal-title" id="modalSayaLabel">Balas Komentar</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/master-admin/comment/{{ $item->id }}/reply"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <b>{{ $item->name }} : </b> <br>
                                                        {{ $item->teks }} <br><br>
                                                        {{-- <label></label> --}}
                                                        <div class="input-group ">
                                                            <textarea name="reply" autocomplete='off' class="form-control @error('reply') is-invalid @enderror" rows="4">{{ $item->reply }}</textarea>
                                                            @error('reply')
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
                                                <button type="submit" class="btn btn-primary text-white">Kirim
                                                </button>
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
