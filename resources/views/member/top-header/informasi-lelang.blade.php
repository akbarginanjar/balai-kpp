@extends('layouts.member')

@section('content')
    <br><br><br><br>
    <div class="container mt-3 py-5 mb-5">
        <h2 style="color: #9d0c47;">Infomari Lelang</h2>
        <div class="row">
            <div class="col-sm-3">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <b>Pencarian</b>
                        <input type="text" class="form-control" placeholder="Harga Minimum"><br>
                        <input type="text" class="form-control" placeholder="Harga Minimum"><br>
                        <button type="submit" class="btn" style="background: #9d0c47; color: white;">Terapkan</button>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="row">
               
                    @foreach ($lelang as $item)
                    <div class="col-sm-4">
                        <div class="card border-0 mb-3 shadow">
                            <img src="{{asset('images/lelang/' .$item->gambar)}}"
                                class="card-img-top" style="height: 200px; widows: 100%; object-fit: cover;" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Rp.{{$item->harga}}</h5>
                                <p class="card-text">{!! $item->deskripsi !!} - {{$item->alamat}}
                                </p>
                                <a href="/informasi-lelang/{{ $item->id }}" class="btn" style="background: #9d0c47; color: white;">Lelang</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
