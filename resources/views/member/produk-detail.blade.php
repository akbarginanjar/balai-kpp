@extends('layouts.member')

@section('content')
    @php
        use Illuminate\Support\Carbon;
        use App\Models\Produk;
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

                        <div class="">
                            <img src="{{ $produk->cover() }}" alt="" class="rounded   " style="width: 100%;">
                        </div>

                        <h2 class="entry-title">
                            <a href="">{{ $produk->nama }}</a>
                        </h2>

                        <div class="entry-meta">
                            <ul>
                                {{-- <li class="d-flex align-items-center"><i class="bi bi-person"></i>{{ $produk->user->name }}
                                </li> --}}
                                {{-- <li class="d-flex align-items-center"><i class="bi bi-clock"></i><time
                                        datetime="2020-01-01">{{ Carbon::parse($artikel->created_at)->translatedFormat('D, d F Y') }}</time></a>
                                </li> --}}
                            </ul>
                        </div>

                        <div class="entry-content mt-3">
                            {!! $produk->deskripsi !!}
                        </div>

                    </article><!-- End blog entry -->
                </div><!-- End blog entries list -->

                <div class="col-lg-4">

                    {{-- <div class="sidebar">
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

                        <h3 class="sidebar-title">Lihat Lainnya</h3>
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


                    </div><!-- End sidebar --> --}}

                </div><!-- End blog sidebar -->

            </div>

        </div>

    </section>
@endsection
