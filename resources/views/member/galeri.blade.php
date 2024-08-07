@extends('layouts.member')

@section('content')
    <div class="container mt-3 py-5 mb-5">
        <section id="portfolio" class="portfolio">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2>Galeri</h2>
                    <p>Foto Galeri {{ $kategoriGaleri->nama }}</p>
                </header>
                <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
                    @foreach ($galeri as $item)
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <div class="portfolio-wrap">
                                <img src="{{ $item->gambar() }}" class="img-fluid" alt=""
                                    style="width: 100%; height: 220px; object-fit: cover; border-radius: 10px;">
                                <div class="portfolio-info">
                                    <h4>{{ $item->judul }}</h4>
                                    <div class="portfolio-links">
                                        <a href="{{ $item->gambar() }}" data-gallery="portfolioGallery"
                                            class="portfokio-lightbox" title="{{ $item->judul }}"><i
                                                class="bi bi-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
