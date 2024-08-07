@extends('layouts.member')

@section('content')
    @php
        use Illuminate\Support\Carbon;
        use App\Models\Tb_video;
    @endphp
    <br> <br> <br>
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">

                    <article class="entry entry-single">

                        <div class="entry-img">
                            <iframe width="100%" height="400" src="https://www.youtube.com/embed/{{ $video->link }}"
                                frameborder="0" style="border-top-left-radius: 15px; border-top-right-radius: 15px;"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>

                        <h2 class="entry-title">
                            <a href="">{{ $video->judul }}</a>
                        </h2>

                        {{-- <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i>{{ $artikel->user->name }}
                                </li>
                                <li class="d-flex align-items-center"><i class="bi bi-calendar"></i><time
                                        datetime="2020-01-01">{{ Carbon::parse($artikel->tgl_pembuatan)->translatedFormat('D, d F Y') }}</time></a>
                                </li>
                                <li class="d-flex align-items-center"><i
                                        class="bi bi-clock"></i><time>{{ $artikel->waktu_pembuatan }}</time></a>
                                </li>
                                <li class="d-flex align-items-center"><i class="bi bi-eye"></i><time>{{ $artikel->viewer }}
                                        Viewer</time></a>
                                </li>
                            </ul>
                        </div> --}}

                        <div class="entry-content mt-3">
                            {!! $video->deskripsi !!}
                        </div>

                    </article><!-- End blog entry -->
                </div><!-- End blog entries list -->



            </div>



        </div>

    </section>
    {{-- <div class="container">
        <section id="recent-blog-posts" class="recent-blog-posts">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <p>Rekomendasi untuk anda</p>
                </header>
                <div class="row">
                    @foreach ($artikels as $data)
                        @if ($data->id != $artikel->id)
                            <div class="col-lg-3 mt-3">
                                <div class="post-box">
                                    <div class="post-img"><img src="{{ $data->gambar() }}" class=""
                                            style="width: 100%; height:160px; object-fit:cover;" alt="">
                                    </div>
                                    <h5 class="post-title">{{ $data->judul }}</h5>
                                    <a href="/artikel/{{ $data->kategoriArtikel->slug }}/{{ $data->slug }}"
                                        class="readmore stretched-link"></a>
                                    <span class="mt-auto" style="font-size: 10px; float:bottom;"><i
                                            class="bi bi-person me-1"></i>
                                        {{ $data->user->name }}
                                        <span class="" style="float: right">
                                            <i class="bi bi-clock me-1"></i><time
                                                datetime="2020-01-01">{{ Carbon::parse($data->created_at)->translatedFormat('d M Y') }}</time></span>
                                    </span>
                                    </span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    </div> --}}

    <script type="text/javascript">
        document.querySelector('.refresh-captcha').addEventListener('click', function() {
            var captchaImage = document.querySelector('.captcha-img');
            var captchaSrc = captchaImage.src.split('?')[0];
            captchaImage.src = captchaSrc + '?' + Math.random();
        });
    </script>
@endsection



{{-- CREATE TABLE tb_comments ( id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, id_artikel BIGINT UNSIGNED NOT NULL, name VARCHAR(255), email VARCHAR(255), teks TEXT, created_at TIMESTAMP NULL, updated_at TIMESTAMP NULL, FOREIGN KEY (id_artikel) REFERENCES tb_artikels(id) ON DELETE CASCADE ); --}}
