@extends('layouts.member')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @php
        use Illuminate\Support\Carbon;
        use App\Models\Tb_artikel;
        use App\Models\Tb_comment;
        $countKomentar = Tb_comment::count();
    @endphp
    {{-- <br><br><br>
    <div class="container mt-5">
        <header class="section-header">
            <p class="mt-4 text-uppercase">{{ $artikel->judul }}</p>
            <span>{{ $artikel->user->name }} |
                {{ Carbon::parse($artikel->created_at)->translatedFormat('D, d F Y') }}</span>
        </header>
        <div class="card border-0">
            {!! $artikel->teks !!}
        </div>
    </div> --}}
    <br> <br> <br>
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">

                    <article class="entry entry-single">

                        <div class="entry-img">
                            <img src="{{ $artikel->gambar() }}" alt="" class="rounded   "
                                style="width: 100%; object-fit: cover">
                        </div>

                        <h2 class="entry-title">
                            <a href="">{{ $artikel->judul }}</a>
                        </h2>

                        <div class="entry-meta">
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
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6><b>Share</b></h6>
                                <a href="javascript:void(0);" class="btn" style="background: rgb(13, 187, 13);"
                                    target="_blank" data-bs-toggle="modal" data-bs-target="#shareModal">
                                    <i class="bi bi-whatsapp text-white" style="font-size: 18px;"></i>
                                </a>

                                <a href="javascript:void(0);" class="btn" style="background: rgb(83, 83, 175);"
                                    target="_blank" data-bs-toggle="modal" data-bs-target="#facebookShareModal">
                                    <i class="bi bi-facebook text-white" style="font-size: 18px;"></i>
                                </a>
                                <a href="javascript:void(0);" class="btn" style="background: rgb(221, 39, 185);"
                                    data-bs-toggle="modal" data-bs-target="#instagramShareModal">
                                    <i class="bi bi-instagram text-white" style="font-size: 18px;"></i>
                                </a>
                            </div>
                        </div>



                        <!-- Input untuk URL artikel -->
                        <input type="text" id="articleUrl" value="{{ $url }}" hidden>

                        <script>
                            function copyLink() {
                                const url = "{{ $url }}";
                                navigator.clipboard.writeText(url).then(() => {

                                }).catch(err => {
                                    console.error("Gagal menyalin tautan: ", err);
                                });
                            }
                        </script>

                        <div class="entry-content mt-3">

                            {!! $artikel->teks !!}
                        </div>

                    </article><!-- End blog entry -->
                </div><!-- End blog entries list -->


                {{-- // modal send whatsap --}}





                <div class="col-lg-4">

                    <div class="sidebar">
                        <h3 class="sidebar-title">Kategori</h3>
                        <div class="sidebar-item categories">
                            <ul>
                                @foreach ($kategoriArtikel as $item)
                                    @php
                                        $artikela = Tb_artikel::where('id_kategori_artikel', $item->id)->get();
                                        $no = $artikela->count();
                                    @endphp
                                    <li><a
                                            href="/artikel/{{ $item->slug }}">{{ $item->nama }}<span>({{ $no }})</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div><!-- End sidebar categories-->

                        <h3 class="sidebar-title">Artikel Terkait</h3>
                        <div class="sidebar-item recent-posts">
                            @php
                                $artikell = Tb_artikel::where('id_kategori_artikel', $artikel->id_kategori_artikel)
                                    ->inRandomOrder()
                                    ->limit(6)
                                    ->get();
                            @endphp
                            @foreach ($artikell as $data)
                                @if ($data->id != $artikel->id)
                                    <div class="post-item clearfix">
                                        <img src="{{ $data->gambar() }}" alt="">
                                        <h4><a
                                                href="/artikel/{{ $data->kategoriArtikel->slug }}/{{ $data->slug }}">{{ $data->judul }}</a>
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

            <div class="col-sm-8">
                <hr>
                <h5><b> Komentar </b></h5>

                @foreach ($komentar as $comment)
                    @if ($comment->publish == 1)
                        <div class="">
                            <div class="p-3">
                                <b> {{ $comment->name }} </b><br>
                                <div class="text-secondary" style="font-size: 12px;">
                                    {{ Carbon::parse($comment->created_at)->translatedFormat('D, d F Y') }}</div>
                                <span class="mt-1" style="font-size: 15px;">{{ $comment->teks }}</span>
                                @if ($comment->reply != null)
                                    <div class="ms-4 mt-2">
                                        <div style="color: rgba(46,67,112,1); font-size: 12px;"><i
                                                class="bi bi-arrow-return-right"></i> Dibalas oleh Admin</div>
                                        <div style="font-size: 15px;" class="ms-3">{{ $comment->reply }}</div>
                                    </div>
                                @endif
                            </div>
                            <div style="background: rgb(206, 206, 206); height: 1px;"></div>
                        </div>
                    @endif
                @endforeach
                <br>
                <b>Leave a reply:</b>
                <div style="font-size: 13;">Your email address will not be published.</div>
                <form action="/artikel/{{ $artikel->kategoriArtikel->slug }}/{{ $artikel->slug }}/sendComment"
                    method="POST">
                    @csrf
                    <input type="hidden" name="id_artikel" value="{{ $artikel->id }}">
                    <div class="form-group">
                        <label style="font-size: 14px;" class="mt-2">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size: 14px;" class="mt-2">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div>
                        <label style="font-size: 14px;" class="mt-2">Komentar</label>
                        <textarea class="form-control" rows="3" name="teks" required></textarea>
                    </div>
                    <div class="form-group mt-2" style="font-size: 14px;">
                        <label for="captcha">Captcha</label>
                        <div>
                            <img src="{{ captcha_src() }}" alt="captcha" class="captcha-img"
                                data-refresh-config="default">
                            <a href="javascript:void(0)" class="refresh-captcha ms-2">Refresh</a>
                        </div>
                        <input type="text" id="captcha" name="captcha" class="form-control mt-2"
                            style="width: 200px;" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" style="background: navy;">Post Comment</button>
                </form>
            </div>

        </div>

    </section>
    <div class="container">
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
    </div>

    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shareModalLabel">Bagikan atau Salin Tautan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Pilih opsi di bawah ini:</p>
                    <a href="https://api.whatsapp.com/send?text={{ $url }}" class="btn btn-success "
                        target="_blank">
                        <i class="bi bi-whatsapp text-white" style="font-size: 18px;"></i>
                        Lanjutkan Bagikan ke WhatsApp
                    </a>
                    <a href="javascript:void(0);" class="btn btn-secondary" onclick="copyLink()"> <i class="bi bi-copy"></i> Salin Tautan</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="facebookShareModal" tabindex="-1" aria-labelledby="facebookShareModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="facebookShareModalLabel">Bagikan ke Facebook atau Salin Tautan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Pilih opsi di bawah ini:</p>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" class="btn btn-primary "
                        target="_blank">
                        <i class="bi bi-facebook text-white" style="font-size: 18px;"></i>
                        Lanjutkan Bagikan ke Facebook
                    </a>
                    <button class="btn btn-secondary" onclick="copyLink()"> <i class="bi bi-copy"></i> Salin Tautan</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="instagramShareModal" tabindex="-1" aria-labelledby="instagramShareModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="instagramShareModalLabel">Bagikan ke Instagram atau Salin Tautan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Pilih opsi di bawah ini:</p>
                    <a href="https://www.instagram.com/sharer/sharer.php?u={{ $url }}" class="btn btn-primary "
                        target="_blank"> 
                        <i class="bi bi-instagram text-white" style="font-size: 18px;"></i>
                        Lanjutkan Bagikan ke Instagram
                    </a>
                    <button class="btn btn-secondary" onclick="copyLink()"> <i class="bi bi-copy"></i> Salin Tautan</button>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        document.querySelector('.refresh-captcha').addEventListener('click', function() {
            var captchaImage = document.querySelector('.captcha-img');
            var captchaSrc = captchaImage.src.split('?')[0];
            captchaImage.src = captchaSrc + '?' + Math.random();
        });
    </script>
@endsection



{{-- CREATE TABLE tb_comments ( id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, id_artikel BIGINT UNSIGNED NOT NULL, name VARCHAR(255), email VARCHAR(255), teks TEXT, created_at TIMESTAMP NULL, updated_at TIMESTAMP NULL, FOREIGN KEY (id_artikel) REFERENCES tb_artikels(id) ON DELETE CASCADE ); --}}
