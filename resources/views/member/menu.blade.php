@extends('layouts.member')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />

    <style>
        #mapid {
            min-height: 500px;
        }

        table tr th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
@endsection

@section('content')
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
    <br><br><br>
    @php
        use App\Models\Tb_kategori_konten_ebook;
        use App\Models\Tb_kategori_konten;
        use App\Models\Tb_artikel;
        use App\Models\Tb_ebook;
        use Illuminate\Support\Carbon;
    @endphp
    <div class="container mt-5"><br>
        @if ($menu->konten->halaman != '')
            @if ($menu->konten->halaman->judul)
                <header class="section-header">
                    <p class="mt-4 text-uppercase">{{ $menu->konten->halaman->judul }}</p>
                </header><br>
            @endif
            {{-- Atas --}}
            <div class="row">
                @if ($menu->konten->halaman->atas_kiri == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($menu->konten->halaman->atas_kiri == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($menu->konten->halaman->atas_kiri == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @elseif ($menu->konten->halaman->atas_kiri == 'Artikel')
                    <div class="col">
                        <x-artikel></x-artikel>
                    </div>
                @elseif ($menu->konten->halaman->atas_kiri == 'Kalender Widget')
                    <div class="col-lg-4">
                        <x-kalender-widget></x-kalender-widget>
                    </div>
                @endif

                @php
                    $kategoriKonten = Tb_kategori_konten::find($menu->konten->halaman->atas_tengah);
                    $kategoriKontenEbook = Tb_kategori_konten_ebook::find($menu->konten->halaman->atas_tengah);
                @endphp
                @if ($menu->konten->halaman->atas_tengah == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($menu->konten->halaman->atas_tengah == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($menu->konten->halaman->atas_tengah == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @elseif ($menu->konten->halaman->atas_tengah == 'Video')
                    <div class="col">
                        <x-video></x-video>
                    </div>
                @elseif ($menu->konten->halaman->atas_tengah == 'Ebook')
                    <div class="col">
                        <x-ebook></x-ebook>
                    </div>
                @elseif ($menu->konten->halaman->atas_tengah == 'Kalender')
                    <div class="col">
                        <x-kalender-besar></x-kalender-besar>
                    </div>
                @elseif (isset($kategoriKonten) && explode(',', $menu->konten->halaman->atas_tengah)[1] == 'konten')
                    <div class="col">
                        @php
                            $konten = Tb_artikel::where('id_kategori_konten', $menu->konten->halaman->atas_tengah)
                                ->orderBy('created_at', 'desc')
                                ->paginate(9);
                        @endphp
                        <div class="" data-aos="fade-up">
                            <div class="" data-aos="fade-up">
                                <div class="row">
                                    @foreach ($konten as $item)
                                        <div class="col-lg-6 mt-3">
                                            <a href="/artikel/{{ $item->kategoriArtikel->slug }}/{{ $item->slug }}">
                                                <div class="row card-artikel">
                                                    <img src="{{ $item->gambar() }}"
                                                        style="object-fit: cover; height: 100px; width: 150px; border-radius: 13px;"
                                                        alt="Avatar" class="col-2">
                                                    <div class="col">
                                                        <h3 class="list-tile__title">{!! Str::limit($item->judul, 30) !!}</h3>
                                                        <span class="list-tile__subtitle"
                                                            style="">{{ Carbon::parse($artikel->tgl_pembuatan)->translatedFormat('D, d F Y') }}
                                                        </span>
                                                        <div class="text-primary">Lihat Detail</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <center>
                            {!! $konten->links() !!}
                        </center>
                    </div>
                @elseif (isset($kategoriKontenEbook) && explode(',', $menu->konten->halaman->atas_tengah)[1] == 'ebook')
                    <h4>Buku</h4>
                    <div class="col">
                        @php
                            $ebook = Tb_ebook::where('id_kategori_konten_ebook', $menu->konten->halaman->atas_tengah)
                                ->orderBy('created_at', 'desc')
                                ->paginate(9);
                        @endphp
                        <div class="" data-aos="fade-up">
                            <div class="" data-aos="fade-up">
                                <div class="row">
                                    @foreach ($ebook as $item)
                                        <div class="col-lg-3">
                                            <div class="card shadow border-0 mb-2">
                                                <div class="card-body">
                                                    <center>
                                                        <div class=""><img src="{{ $item->gambar() }}" class="rounded"
                                                                style="height: 200px; width: 100%; object-fit: cover;"
                                                                alt="">
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
                        </div>
                        <center>
                            {!! $ebook->links() !!}
                        </center>
                    </div>
                @endif
                @if ($menu->konten->halaman->atas_kanan == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($menu->konten->halaman->atas_kanan == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($menu->konten->halaman->atas_kanan == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @elseif ($menu->konten->halaman->atas_kanan == 'Artikel')
                    <div class="col">
                        <x-artikel></x-artikel>
                    </div>
                @elseif ($menu->konten->halaman->atas_kanan == 'Kalender Widget')
                    <div class="col-lg-4">
                        <x-kalender-widget></x-kalender-widget>
                    </div>
                @endif
            </div>
            {{-- Akhir Atas --}}
            @if ($menu->konten->halaman->gambar != null)
                <img class="rounded" src="{{ $menu->konten->halaman ? $menu->konten->halaman->gambar() : 'no_image' }}"
                    alt="Gambar">
            @endif

            @if ($menu->konten->halaman->teks)
                <div class="card border-0">
                    {!! $menu->konten->halaman->teks !!}
                </div>
            @endif
            {{-- Tengah --}}
            <hr>
            @php
                $kategoriKonten = Tb_kategori_konten::find($menu->konten->halaman->tengah);
                $kategoriKontenEbook = Tb_kategori_konten_ebook::find($menu->konten->halaman->tengah);
            @endphp
            <div class="row">
                @if ($menu->konten->halaman->tengah_kiri == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($menu->konten->halaman->tengah_kiri == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($menu->konten->halaman->tengah_kiri == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @elseif ($menu->konten->halaman->tengah_kiri == 'Artikel')
                    <div class="col">
                        <x-artikel></x-artikel>
                    </div>
                @endif
                @if ($menu->konten->halaman->tengah == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($menu->konten->halaman->tengah == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($menu->konten->halaman->tengah == 'Video')
                    <div class="col">
                        <x-video></x-video>
                    </div>
                @elseif ($menu->konten->halaman->tengah == 'Ebook')
                    <div class="col">
                        <x-ebook></x-ebook>
                    </div>
                @elseif ($menu->konten->halaman->tengah == 'Kalender')
                    <div class="col">
                        <x-kalender-besar></x-kalender-besar>
                    </div>
                @elseif (isset($kategoriKonten) && explode(',', $menu->konten->halaman->tengah)[1] == 'konten')
                    <div class="col">
                        @php
                            $konten = Tb_artikel::where('id_kategori_konten', $menu->konten->halaman->tengah)
                                ->orderBy('created_at', 'desc')
                                ->paginate(9);
                        @endphp
                        <div class="" data-aos="fade-up">
                            <div class="" data-aos="fade-up">
                                <div class="row">
                                    @foreach ($konten as $item)
                                        <div class="col-lg-6 mt-3">
                                            <a href="/artikel/{{ $item->kategoriArtikel->slug }}/{{ $item->slug }}">
                                                <div class="row card-artikel">
                                                    <img src="{{ $item->gambar() }}"
                                                        style="object-fit: cover; height: 100px; width: 150px; border-radius: 13px;"
                                                        alt="Avatar" class="col-2">
                                                    <div class="col">
                                                        <h3 class="list-tile__title">{!! Str::limit($item->judul, 30) !!}</h3>
                                                        <span class="list-tile__subtitle"
                                                            style="">{{ Carbon::parse($artikel->tgl_pembuatan)->translatedFormat('D, d F Y') }}
                                                        </span>
                                                        <div class="text-primary">Lihat Detail</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <center>
                            {!! $konten->links() !!}
                        </center>
                        {{-- <x-kontak></x-kontak> --}}
                    </div>
                @elseif (isset($kategoriKontenEbook) && explode(',', $menu->konten->halaman->tengah)[1] == 'ebook')
                    <h4>Karya Ilmiah</h4>
                    <div class="col">
                        @php
                            $ebook = Tb_ebook::where('id_kategori_konten_ebook', $menu->konten->halaman->tengah)
                                ->orderBy('created_at', 'desc')
                                ->paginate(9);
                        @endphp
                        <div class="" data-aos="fade-up">
                            <div class="" data-aos="fade-up">
                                <div class="row">
                                    @foreach ($ebook as $item)
                                        <div class="col-lg-3">
                                            <div class="card shadow border-0 mb-2">
                                                <div class="card-body">
                                                    <center>
                                                        <div class=""><img src="{{ $item->gambar() }}"
                                                                class="rounded"
                                                                style="height: 200px; width: 100%; object-fit: cover;"
                                                                alt="">
                                                        </div>
                                                        <br>
                                                        <h6 class=""><b> {{ Str::limit($item->judul, 50) }} </b>
                                                        </h6>
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
                        </div>
                        <center>
                            {!! $ebook->links() !!}
                        </center>
                    </div>
                @elseif ($menu->konten->halaman->tengah == 'Artikel')
                    <div class="col">
                        <x-artikel></x-artikel>
                    </div>
                @endif
                @if ($menu->konten->halaman->tengah_kanan == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($menu->konten->halaman->tengah_kanan == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($menu->konten->halaman->tengah_kanan == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @elseif ($menu->konten->halaman->tengah_kanan == 'Artikel')
                    <div class="col">
                        <x-artikel></x-artikel>
                    </div>
                @endif
            </div>
            {{-- Akhir Tengah --}}
            {{-- Bawah --}}
            <div class="row">
                @if ($menu->konten->halaman->bawah_kiri == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($menu->konten->halaman->bawah_kiri == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($menu->konten->halaman->bawah_kiri == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @elseif ($menu->konten->halaman->bawah_kiri == 'Artikel')
                    <div class="col">
                        <x-artikel></x-artikel>
                    </div>
                @endif

                @php
                    $kategoriKonten = Tb_kategori_konten::find($menu->konten->halaman->bawah_tengah);
                    $kategoriKontenEbook = Tb_kategori_konten_ebook::find($menu->konten->halaman->bawah_tengah);
                @endphp
                @if ($menu->konten->halaman->bawah_tengah == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($menu->konten->halaman->bawah_tengah == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($menu->konten->halaman->bawah_tengah == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @elseif ($menu->konten->halaman->bawah_tengah == 'Video')
                    <div class="col">
                        <x-video></x-video>
                    </div>
                @elseif ($menu->konten->halaman->bawah_tengah == 'Ebook')
                    <div class="col">
                        <x-ebook></x-ebook>
                    </div>
                @elseif ($menu->konten->halaman->bawah_tengah == 'Kalender')
                    <div class="col">
                        <x-kalender-besar></x-kalender-besar>
                    </div>
                @elseif (isset($kategoriKonten) && explode(',', $menu->konten->halaman->bawah_tengah)[1] == 'konten')
                    <div class="col">
                        @php
                            $konten = Tb_artikel::where('id_kategori_konten', $menu->konten->halaman->bawah_tengah)
                                ->orderBy('created_at', 'desc')
                                ->paginate(9);
                        @endphp
                        <div class="" data-aos="fade-up">
                            <div class="" data-aos="fade-up">
                                <div class="row">
                                    @foreach ($konten as $item)
                                        <div class="col-lg-6 mt-3">
                                            <a href="/artikel/{{ $item->kategoriArtikel->slug }}/{{ $item->slug }}">
                                                <div class="row card-artikel">
                                                    <img src="{{ $item->gambar() }}"
                                                        style="object-fit: cover; height: 100px; width: 150px; border-radius: 13px;"
                                                        alt="Avatar" class="col-2">
                                                    <div class="col">
                                                        <h3 class="list-tile__title">{!! Str::limit($item->judul, 30) !!}</h3>
                                                        <span class="list-tile__subtitle"
                                                            style="">{{ Carbon::parse($artikel->tgl_pembuatan)->translatedFormat('D, d F Y') }}
                                                        </span>
                                                        <div class="text-primary">Lihat Detail</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <center>
                            {!! $konten->links() !!}
                        </center>
                        {{-- <x-artikel></x-artikel> --}}
                    </div>
                @elseif (isset($kategoriKontenEbook) && explode(',', $menu->konten->halaman->bawah_tengah)[1] == 'ebook')
                    <div class="col">
                        @php
                            $ebook = Tb_ebook::where('id_kategori_konten_ebook', $menu->konten->halaman->bawah_tengah)
                                ->orderBy('created_at', 'desc')
                                ->paginate(9);
                        @endphp
                        <div class="" data-aos="fade-up">
                            <div class="" data-aos="fade-up">
                                <div class="row">
                                    @foreach ($ebook as $item)
                                        <div class="col-lg-3">
                                            <div class="card shadow border-0 mb-2">
                                                <div class="card-body">
                                                    <center>
                                                        <div class=""><img src="{{ $item->gambar() }}"
                                                                class="rounded"
                                                                style="height: 200px; width: 100%; object-fit: cover;"
                                                                alt="">
                                                        </div>
                                                        <br>
                                                        <h6 class=""><b> {{ Str::limit($item->judul, 50) }} </b>
                                                        </h6>
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
                        </div>
                        <center>
                            {!! $ebook->links() !!}
                        </center>
                    </div>
                @endif
                @if ($menu->konten->halaman->bawah_kanan == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($menu->konten->halaman->bawah_kanan == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($menu->konten->halaman->bawah_kanan == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @elseif ($menu->konten->halaman->bawah_kanan == 'Artikel')
                    <div class="col">
                        <x-artikel></x-artikel>
                    </div>
                @endif
            </div>
            {{-- Akhir Bawah --}}
        @elseif ($menu->konten->artikel != '')
            @if ($menu->konten->artikel->gambar != null)
                <img class="rounded" src="{{ $menu->konten->artikel ? $menu->konten->artikel->gambar() : 'no_image' }}"
                    alt="Gambar">
            @endif
            <h1 class="mt-4 text-uppercase">{{ $menu->konten->artikel->judul }}</h1>
            <div class="card border-0">
                {!! $menu->konten->artikel->teks !!}
            </div>
        @elseif ($menu->konten->kegiatan != '')
            @if ($menu->konten->kegiatan->gambar != null)
                <img class="rounded" src="{{ $menu->konten->kegiatan ? $menu->konten->kegiatan->gambar() : 'no_image' }}"
                    alt="Gambar">
            @endif
            <h1 class="mt-4 text-uppercase">{{ $menu->konten->kegiatan->judul }}</h1>
            <div class="card border-0">
                {!! $menu->konten->kegiatan->teks !!}
            </div>
        @else
            <br><br><br>
            <center>Tidak Ada Konten</center>
            <br><br>
            <br>
        @endif
    </div>
@endsection
