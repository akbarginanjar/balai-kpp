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
@section('js')
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>

    <script>
        var map = L.map('mapid').setView([{{ config('leaflet.map_center_latitude') }},
            {{ config('leaflet.map_center_longitude') }}
        ], {{ config('leaflet.zoom_level') }});

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        var markers = L.markerClusterGroup();

        axios.get('{{ route('api.peta.index') }}')
            .then(function(response) {
                var marker = L.geoJSON(response.data, {
                    pointToLayer: function(geoJsonPoint, latlng) {
                        return L.marker(latlng).bindPopup(function(layer) {
                            return layer.feature.properties.map_popup_content;
                        });
                    }
                });
                markers.addLayer(marker);
            })
            .catch(function(error) {
                console.log(error);
            });
        map.addLayer(markers);

        var theMarker;
    </script>
@endsection

@section('content')
    @php
        use App\Models\Tb_kategori_konten;
        use App\Models\Tb_artikel;
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
    <br><br><br>
    <div class="container mt-5" style="margin-top: 120px;">
        @if ($submenu->konten->halaman != '')
            @if ($submenu->konten->halaman->judul)
                <header class="section-header">
                    <p class="mt-4 text-uppercase">{{ $submenu->konten->halaman->judul }}</p>
                </header>
            @endif
            {{-- Atas --}}
            <div class="row">
                @if ($submenu->konten->halaman->atas_kiri == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($submenu->konten->halaman->atas_kiri == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($submenu->konten->halaman->atas_kiri == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @elseif ($submenu->konten->halaman->atas_kiri == 'Kalender Widget')
                    <div class="col-lg-4">
                        <x-kalender-widget></x-kalender-widget>
                    </div>
                @endif

                @php
                    $kategoriKonten = Tb_kategori_konten::find($submenu->konten->halaman->atas_tengah);
                @endphp
                @if ($submenu->konten->halaman->atas_tengah == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($submenu->konten->halaman->atas_tengah == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($submenu->konten->halaman->atas_tengah == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @elseif ($submenu->konten->halaman->atas_tengah == 'Video')
                    <div class="col">
                        <x-video></x-video>
                    </div>
                @elseif ($submenu->konten->halaman->atas_tengah == 'Ebook')
                    <div class="col">
                        <x-ebook></x-ebook>
                    </div>
                @elseif ($submenu->konten->halaman->atas_tengah == 'Kalender')
                    <div class="col">
                        <x-kalender-besar></x-kalender-besar>
                    </div>
                @elseif (isset($kategoriKonten))
                    <div class="col">
                        @php
                            $konten = Tb_artikel::where('id_kategori_konten', $submenu->konten->halaman->atas_tengah)
                                ->orderBy('created_at', 'desc')
                                ->paginate(9);
                        @endphp
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
                        <center>
                            {!! $konten->links() !!}
                        </center>
                    </div>
                @endif
                @if ($submenu->konten->halaman->atas_kanan == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($submenu->konten->halaman->atas_kanan == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($submenu->konten->halaman->atas_kanan == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @elseif ($submenu->konten->halaman->atas_kanan == 'Kalender Widget')
                    <div class="col-lg-4">
                        <x-kalender-widget></x-kalender-widget>
                    </div>
                @endif
            </div>
            {{-- Akhir Atas --}}
            @if ($submenu->konten->halaman->gambar != null)
                <img class="rounded"
                    src="{{ $submenu->konten->halaman ? $submenu->konten->halaman->gambar() : 'no_image' }}" alt="Gambar">
            @endif

            @if ($submenu->konten->halaman->teks)
                <div class="card border-0">
                    {!! $submenu->konten->halaman->teks !!}
                </div>
            @endif
            {{-- Tengah --}}
            <div class="row">
                @if ($submenu->konten->halaman->tengah_kiri == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($submenu->konten->halaman->tengah_kiri == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($submenu->konten->halaman->tengah_kiri == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @endif

                @php
                    $kategoriKonten = Tb_kategori_konten::find($submenu->konten->halaman->tengah);
                @endphp
                @if ($submenu->konten->halaman->tengah == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($submenu->konten->halaman->tengah == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($submenu->konten->halaman->tengah == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @elseif ($submenu->konten->halaman->tengah == 'Video')
                    <div class="col">
                        <x-video></x-video>
                    </div>
                @elseif ($submenu->konten->halaman->tengah == 'Ebook')
                    <div class="col">
                        <x-ebook></x-ebook>
                    </div>
                @elseif ($submenu->konten->halaman->tengah == 'Kalender')
                    <div class="col">
                        <x-kalender-besar></x-kalender-besar>
                    </div>
                @elseif (isset($kategoriKonten))
                    <div class="col">
                        @php
                            $konten = Tb_artikel::where('id_kategori_konten', $submenu->konten->halaman->tengah)
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
                                                        <h3 class="list-tile__title">{!! Str::limit($item->judul, 60) !!}</h3>
                                                        <span class="list-tile__subtitle">{!! Str::limit($item->teks, 70) !!}</span>
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
                @endif
                @if ($submenu->konten->halaman->tengah_kanan == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($submenu->konten->halaman->tengah_kanan == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($submenu->konten->halaman->tengah_kanan == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @endif
            </div>
            {{-- Akhir Tengah --}}
            {{-- Bawah --}}
            <div class="row">
                @if ($submenu->konten->halaman->bawah_kiri == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($submenu->konten->halaman->bawah_kiri == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($submenu->konten->halaman->bawah_kiri == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @endif

                @php
                    $kategoriKonten = Tb_kategori_konten::find($submenu->konten->halaman->bawah_tengah);
                @endphp
                @if ($submenu->konten->halaman->bawah_tengah == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($submenu->konten->halaman->bawah_tengah == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($submenu->konten->halaman->bawah_tengah == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @elseif ($submenu->konten->halaman->bawah_tengah == 'Video')
                    <div class="col">
                        <x-video></x-video>
                    </div>
                @elseif ($submenu->konten->halaman->bawah_tengah == 'Ebook')
                    <div class="col">
                        <x-ebook></x-ebook>
                    </div>
                @elseif ($submenu->konten->halaman->bawah_tengah == 'Kalender')
                    <div class="col">
                        <x-kalender-besar></x-kalender-besar>
                    </div>
                @elseif (isset($kategoriKonten))
                    <div class="col">
                        @php
                            $konten = Tb_artikel::where('id_kategori_konten', $submenu->konten->halaman->bawah_tengah)
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
                                                        <h3 class="list-tile__title">{!! Str::limit($item->judul, 60) !!}</h3>
                                                        <span class="list-tile__subtitle">{!! Str::limit($item->teks, 70) !!}</span>
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
                @endif
                @if ($submenu->konten->halaman->bawah_kanan == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($submenu->konten->halaman->bawah_kanan == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($submenu->konten->halaman->bawah_kanan == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @endif
            </div>
            {{-- Akhir Bawah --}}
        @elseif ($submenu->konten->artikel != '')
            @if ($submenu->konten->artikel->gambar != null)
                <img class="rounded"
                    src="{{ $submenu->konten->artikel ? $submenu->konten->artikel->gambar() : 'no_image' }}"
                    alt="Gambar">
            @endif
            <h1 class="mt-4 text-uppercase">{{ $submenu->konten->artikel->judul }}</h1>
            <div class="card border-0">
                {!! $submenu->konten->artikel->teks !!}
            </div>
        @elseif ($submenu->konten->kategoriArtikel != '')
            @php
                // use App\Models\Tb_kategori_artikel;
                $artikel = Tb_artikel::where('id_kategori_artikel', $submenu->konten->kategoriArtikel->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(8);
            @endphp
            <h5 class="mt-4"><b> Kategori {{ $submenu->konten->kategoriArtikel->nama }}</b></h5>
            <div class="" data-aos="fade-up">
                <div class="" data-aos="fade-up">
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
            </div>
            <center>
                {!! $artikel->links() !!}
            </center>
        @elseif ($submenu->konten->kegiatan != '')
            @if ($submenu->konten->kegiatan->gambar != null)
                <img class="rounded"
                    src="{{ $submenu->konten->kegiatan ? $submenu->konten->kegiatan->gambar() : 'no_image' }}"
                    alt="Gambar">
            @endif
            <h1 class="mt-4 text-uppercase">{{ $submenu->konten->kegiatan->judul }}</h1>
            <div class="card border-0">
                {!! $submenu->konten->kegiatan->teks !!}
            </div>
        @else
            <br><br><br>
            <center>Tidak Ada Konten</center>
            <br><br>
            <br>
        @endif
    </div>
@endsection
