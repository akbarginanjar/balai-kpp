@extends('layouts.member')

@section('content')
    @php
        use Illuminate\Support\Carbon;
        use App\Models\Tb_ebook;
    @endphp
    {{-- <br><br><br>
    <div class="container mt-5">
        <header class="section-header">
            <p class="mt-4 text-uppercase">{{ $ebook->judul }}</p>
            <span>{{ $ebook->user->name }} |
                {{ Carbon::parse($ebook->created_at)->translatedFormat('D, d F Y') }}</span>
        </header>
        <div class="card border-0">
            {!! $ebook->teks !!}
        </div>
    </div> --}}
    <br> <br> <br>
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">

                    <article class="entry entry-single">

                        <div class="row">
                            <div class="col-sm-4">
                                <img src="{{ $ebook->gambar() }}" alt="" class="rounded" style="width: 200px;">
                            </div>
                            <div class="col-sm">
                                <h3>
                                    <b>{{ $ebook->judul }}</b>
                                </h3>
                                @if ($ebook->file != null)
                                    <a href="/images/ebook/file/{{ $ebook->file }}" class="btn btn-primary btn-sm"
                                        target="_blank">Lihat
                                        E-book</a>
                                @elseif($ebook->link != null)
                                    <a href="{{ $ebook->link }}" class="btn btn-primary btn-sm" target="_blank">Lihat
                                        E-book</a>
                                @endif
                            </div>
                        </div>
                        <br>


                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i>{{ $ebook->user->name }}
                                </li>
                                <li class="d-flex align-items-center"><i class="bi bi-calendar"></i><time
                                        datetime="2020-01-01">{{ Carbon::parse($ebook->tgl_pembuatan)->translatedFormat('D, d F Y') }}</time></a>
                                </li>
                                <li class="d-flex align-items-center"><i
                                        class="bi bi-clock"></i><time>{{ $ebook->waktu_pembuatan }}</time></a>
                                </li>
                                <li class="d-flex align-items-center"><i class="bi bi-eye"></i><time>{{ $ebook->viewer }}
                                        Viewer</time></a>
                                </li>
                            </ul>
                        </div>
                        {{-- <div class="row">
                            <div class="col">
                                <h6><b>Share</b></h6>
                                <a href="https://api.whatsapp.com/send?text={{ $url }}" class="btn"
                                    style="background: rgb(13, 187, 13);" target="_blank">
                                    <i class="bi bi-whatsapp text-white" style="font-size: 18px;"></i>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank"
                                    class="btn" style="background: rgb(83, 83, 175);">
                                    <i class="bi bi-facebook text-white" style="font-size: 18px;"></i>
                                </a>
                                <a class="btn" onclick="copyUrlInstagram()" style="background: rgb(221, 39, 185);">
                                    <i class="bi bi-instagram text-white" style="font-size: 18px;"></i>
                                </a>
                            </div>
                        </div> --}}
                        <!-- Input untuk URL artikel -->
                        <input type="text" id="articleUrl" value="{{ $url }}" hidden>

                        <script>
                            function copyUrlInstagram() {
                                var copyText = document.getElementById("articleUrl");
                                copyText.select();
                                copyText.setSelectionRange(0, 99999); // For mobile devices
                                document.execCommand("copy");
                                alert("Link berhasil disalin: " + copyText.value);
                            }
                        </script>

                        <div class="entry-content mt-3">

                            {!! $ebook->teks !!}
                        </div>

                    </article><!-- End blog entry -->
                </div><!-- End blog entries list -->

                <div class="col-lg-4">

                    <div class="sidebar">
                        <h3 class="sidebar-title">Kategori</h3>
                        <div class="sidebar-item categories">
                            <ul>
                                @foreach ($kategoriEbook as $item)
                                    @php
                                        $ebookKategori = Tb_ebook::where('id_kategori_ebook', $item->id)->get();
                                        $no = $ebookKategori->count();
                                    @endphp
                                    <li><a
                                            href="/ebook/{{ $item->slug }}">{{ $item->nama }}<span>({{ $no }})</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div><!-- End sidebar categories-->

                        <h3 class="sidebar-title">Ebook Terkait</h3>
                        <div class="sidebar-item recent-posts">
                            @php
                                $ebookl = Tb_ebook::where('id_kategori_ebook', $ebook->id_kategori_ebook)
                                    ->inRandomOrder()
                                    ->limit(6)
                                    ->get();
                            @endphp
                            @foreach ($ebookl as $data)
                                @if ($data->id != $ebook->id)
                                    <div class="post-item clearfix">
                                        <img src="{{ $data->gambar() }}" alt="">
                                        <h4><a
                                                href="/ebook/{{ $data->kategoriEbook->slug }}/{{ $data->slug }}">{{ $data->judul }}</a>
                                        </h4>
                                        <time
                                            datetime="2020-01-01">{{ Carbon::parse($data->created_at)->translatedFormat('D, d F Y') }}</time>
                                    </div>
                                @endif
                            @endforeach


                        </div><!-- End sidebar recent posts-->


                    </div><!-- End sidebar -->

                </div><!-- End blog sidebar -->

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
                    @foreach ($ebooks as $data)
                        @if ($data->id != $ebook->id)
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
