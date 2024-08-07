@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#peta').DataTable();
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
            <h4 class="page-title">peta</h4>
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
                    <a href="/admin/peta">peta</a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="">Data Peta</a>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-10">
                        <div class="card-title">Data Peta</div>
                    </div>
                    <div class="col">
                        <a class="btn btn-primary text-white float-right" href="{{ route('peta.create') }}">Tambah
                            Peta</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table responsive-3" id="peta">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Wilayah</th>
                                <th>Alamat</th>
                                <th>Longitude</th>
                                <th>Latitude</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($peta as $item)
                                <tr>
                                    <td data-header="No">{{ $no++ }}</td>
                                    <td data-header="">{{ $item->wilayah->nama_wilayah }}</td>
                                    <td data-header="">{{ $item->alamat }}</td>
                                    <td data-header="">{{ $item->longitude }}</td>
                                    <td data-header="">{{ $item->latitude }}</td>
                                    <td>
                                        <form action="{{ route('peta.destroy', $item->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <a href="{{ route('peta.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning text-white" data-toggle="tooltip"
                                                data-placement="top" title="Edit"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            <button type="submit" class="btn btn-danger btn-sm delete-confirm"
                                                data-toggle="tooltip" data-placement="top" title="Hapus"><i
                                                    class="fa-solid fa-trash"></i></button>
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
@endsection
