@extends('layouts.member')
@section('content')
    @php
        use Illuminate\Support\Carbon;
    @endphp

    <div>
        <br>
        <div class="container mt-5">
            <section id="recent-blog-posts" class="recent-blog-posts">
                <h5><b>Kategori E-book {{ $kategoriEbook->nama }}</b></h5><br>
                <div class="" data-aos="fade-up">
                    <div class="row">
                        @foreach ($ebook as $item)
                            <div class="col-lg-3">
                                <div class="card shadow border-0">
                                    <div class="card-body">
                                        <center>
                                            <div class=""><img src="{{ $item->gambar() }}" class="rounded"
                                                    style="height: 200px; width: 100%; object-fit: cover;" alt="">
                                            </div>
                                            <br>
                                            <h6 class=""><b> {{ Str::limit($item->judul, 50) }} </b></h6>
                                            <a href="/ebook/{{ $item->kategoriEbook->nama }}/{{ $item->slug }}"
                                                class="readmore stretched-link mt-auto">
                                            </a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <br>
                <center>
                    {!! $ebook->links() !!}
                </center>
            </section>
        </div>
    </div>
@endsection
