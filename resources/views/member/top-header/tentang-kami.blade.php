@extends('layouts.member')

@section('content')
    <br><br>
    <div class="container mt-3 py-5 mb-5">
        <section id="portfolio" class="portfolio">
            <div class="container" data-aos="fade-up">
                <h2 style="color: #9d0c47;" >{{ $tentangkami->judul }}</h2>
                {!! $tentangkami->isi !!}
            </div>
        </section>
    </div>
@endsection
