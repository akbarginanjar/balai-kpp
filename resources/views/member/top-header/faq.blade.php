@extends('layouts.member')

@section('content')
    <br><br><br><br>
    <div class="container mt-3 py-5 mb-5">
        <h2 style="color: #9d0c47;">{{ $faq->pertanyaan }}</h2>
        <div>
       <p>{!! $faq->jawaban !!}</p>
        </div>
    </div>
@endsection
