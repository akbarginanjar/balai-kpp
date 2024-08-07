@php
    use App\Models\Tb_kategori_galeri;
    $kategoriGaleri = Tb_kategori_galeri::all();
@endphp
<div>
    <div class="container mb-5">
        <section id="recent-blog-posts" class="recent-blog-posts">

            <div class="container" data-aos="fade-up">
                {{-- <header class="section-header"> --}}
                {{-- <p class="text-center h4" style="color: rgb(30, 217, 30);">Galeri</p> --}}
                {{-- </header> --}}
                <div class="row">
                    @foreach ($kategoriGaleri as $item)
                        <div class="col-lg-4">
                            <div class="post-box">
                                <div class="post-img"><img src="{{ $item->cover() }}" class="img-fluid" alt="">
                                </div>
                                <h3 class="post-title">{{ $item->nama }}</h3>
                                <a href="galeri/{{ $item->slug }}"
                                    class="readmore stretched-link mt-auto"><span>Lihat</span><i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
