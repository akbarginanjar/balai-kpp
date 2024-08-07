@extends('layouts.member')
@section('content')
    <br><br><br><br>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <br><br><br>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <div class="container">   
        
        
       <div class="row">
       <div class="col-md-6">
        <img src="{{asset('images/lelang/'. $lelang->gambar)}}" style="width: 100%; border-radius: 10px">
       </div>
       <div class="col">
        <div class="card  shadow " style="border-radius: 10px">
           <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-success">{{$lelang->nama}}</strong>
              <h6 class="mb-1">
                 <span class="text-dark" href="#">Rp. {{$lelang->harga}}</span>
              </h6>
              <span class="card-text mb-auto"> Keterangan : {!! $lelang->deskripsi !!}</span>
              <span class="card-text mb-auto">Alamat : {!! $lelang->alamat !!}</span>
              <div class="mb-1 text-muted small">{{$lelang->created_at}}</div>
              {{-- <a class="btn btn-outline-success btn-sm" href="http://www.jquery2dotnet.com/">Continue reading</a> --}}
           </div>
        </div>
     </div>
       </div>
    </div>
@endsection
