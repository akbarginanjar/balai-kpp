@extends('layouts.member')
@section('content')
    @php
        use Illuminate\Support\Carbon;
    @endphp
    <style>
        .card-artikel {
            display: flex;
            align-items: center;
            background-color: white;
            padding: 10px;
            width: 100%;
            border-radius: 13px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .card-artikel:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .list-tile__title {
            margin: 0;
            font-size: 1.1em;
            color: #333;
            font-weight: bold;
        }

        .list-tile__subtitle {
            margin: 5px 0 0;
            font-size: 0.9em;
            color: #666;
        }
    </style>

    <div>
        <br>
        <div class="container py-5 mb-5">
            <section id="recent-blog-posts" class="recent-blog-posts">
                <div class="container" data-aos="fade-up">
                    <h4 class="" style="font-family: 'Nunito', sans-serif; color: #2E4370"><b>Kategori Artikel
                            {{ $kategoriArtikel->nama }}</b>
                    </h4>
                    <div class="row">
                        @foreach ($artikel as $item)
                            <div class="col-lg-6 mt-3">
                                <a href="/artikel/{{ $item->kategoriArtikel->slug }}/{{ $item->slug }}">
                                    <div class="row card-artikel">
                                        <img src="{{ $item->gambar() }}"
                                            style="object-fit: cover; height: 100px; width: 150px; border-radius: 13px;"
                                            alt="Avatar" class="col-2">
                                        <div class="col">
                                            <h3 class="list-tile__title">{!! Str::limit($item->judul, 60) !!}</h3>
                                            <span class="list-tile__subtitle">{!! Str::limit($item->teks, 70) !!}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <br>
                <center>
                    {!! $artikel->links() !!}
                </center>
            </section>
        </div>
    </div>
@endsection
