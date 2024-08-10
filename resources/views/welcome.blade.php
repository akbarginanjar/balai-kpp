@extends('layouts.member')

@section('js')
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
@endsection


@section('content')
    @php
        use Illuminate\Support\Facades\Http;
        use App\Models\Tb_tentang;
        use App\Models\Tb_keuntungan;
        use App\Models\Tb_pertanyan;
        use App\Models\Produk;
        use App\Models\Tb_artikel;
        use App\Models\Tb_slide;
        use App\Models\Tb_galeri;
        use App\Models\Tb_video;
        use Illuminate\Support\Carbon;
        use App\Models\Tb_setting;
        use App\Models\KalenderKegiatan;

        $kalender = KalenderKegiatan::orderBy('created_at', 'asc')->get();
        if (isset($request->year)) {
            $year = $request->input('year');
            $kalender = KalenderKegiatan::whereYear('waktu_kegiatan', $year)->get();
        }
        $setting = Tb_setting::find(1);
        $tentang = Tb_tentang::find(1);
        $keuntungan = Tb_keuntungan::find(1);
        $pertanyaan = Tb_pertanyan::all();
        $artikel = Tb_artikel::orderBy('created_at', 'desc')->paginate(8);
        $berita = Tb_artikel::orderBy('created_at', 'desc')->where('id_kategori_konten', 3)->paginate(3);
        $slide = Tb_slide::orderBy('created_at', 'desc')->get();
        $galeri = Tb_galeri::orderBy('created_at', 'desc')->get();
        $video = Tb_video::orderBy('created_at', 'desc')->paginate(7);
    @endphp
    <!-- ======= Hero Section ======= -->
    <br><br><br>

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
            font-size: 0.8em;
            color: #666;
        }

        .carousel-item {
            position: relative;
        }

        .carousel-item .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Change the color and opacity as needed */
            z-index: 1;
        }

        .carousel-caption {
            z-index: 2;
            /* Ensure the caption is above the overlay */
        }

        .card-menu {
            background: white;
            padding: 15px;
            border-radius: 50px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.057);
        }

        .category-container {
            padding: 30px;
            width: 100%;
            overflow-x: auto;
        }

        .category-container::-webkit-scrollbar {
            display: none;
        }

        .category-logos {
            display: inline-flex;
        }

        .category {
            margin-right: 80px;
        }

        .image-category {
            height: 40px;
        }

        .scrollable-container {
            overflow-x: auto;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            /* For smooth scrolling on iOS */
            scrollbar-width: none;
            /* Hide scrollbar in Firefox */
        }

        .scrollable-container::-webkit-scrollbar {
            display: none;
            /* Hide scrollbar in Chrome, Safari, and Opera */
        }

        .scrollable-container img {
            display: inline-block;
            width: 300px;
            margin-right: 10px;
            /* Optional spacing between images */
        }

        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(255, 255, 255, 0.7);
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
        }

        .scroll-btn.left {
            left: 10px;
        }

        .scroll-btn.right {
            right: 10px;
        }

        .gradient-btn {
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
            border: none;
            color: white;
            padding: 10px 20px;
            width: 100%;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            transition: background 0.3s ease-in-out;
            border-radius: 25px;
        }

        .gradient-btn:hover {
            background: linear-gradient(45deg, #bc1888 0%, #cc2366 25%, #dc2743 50%, #e6683c 75%, #f09433 100%);
        }

        .whatsapp-float {
            position: fixed;
            width: 50px;
            height: 50px;
            bottom: 70px;
            right: 20px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .whatsapp-icon {
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }
    </style>
    @php
        use Illuminate\Support\Str;
    @endphp

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($slide as $key => $item)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ $item->gambar() }}" class="" style="width: 100%; height: 400px; object-fit: cover;"
                        alt="...">
                    <div class="overlay"></div>
                    <div class="carousel-caption d-none d-md-block">
                        <h3>{{ $item->deskripsi }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <main id="main">


        <div>
            <h5 class="text-center text--primary mb-4 mt-4">Layanan yang banyak diakses</h5>
            <center style=" background: rgba(245, 245, 245, 0.583);">
                <div class="container">
                    <div class="category-container">
                        <div class="category-logos">
                            <a class="category" style="cursor: pointer"><i
                                    class="fa-solid card-menu fa-newspaper text--primary mb-2" style="font-size: 35px;"></i>
                                <br />
                                <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Berita</span>
                            </a>
                            <a class="category" style="cursor: pointer"><i
                                    class="fa-solid card-menu fa-file-lines text--primary mb-2"
                                    style="font-size: 35px;"></i>
                                <br />
                                <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Artikel</span>
                            </a>
                            <a class="category" style="cursor: pointer"><i
                                    class="fa-solid card-menu fa-images text--primary mb-2" style="font-size: 35px;"></i>
                                <br />
                                <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Galeri</span>
                            </a>
                            <a class="category" style="cursor: pointer"><i
                                    class="fa-solid card-menu fa-video text--primary mb-2" style="font-size: 35px;"></i>
                                <br />
                                <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Video</span>
                            </a>
                            <a class="category" style="cursor: pointer"><i
                                    class="fa-solid card-menu fa-book text--primary mb-2" style="font-size: 35px;"></i>
                                <br />
                                <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Ebook</span>
                            </a>
                            <a class="category" style="cursor: pointer"><i
                                    class="fa-solid card-menu fa-users text--primary mb-2" style="font-size: 35px;"></i>
                                <br />
                                <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Forum
                                </span>
                            </a>
                            <a class="category" style="cursor: pointer"><i
                                    class="fa-solid card-menu fa-flag text--primary mb-2" style="font-size: 35px;"></i>
                                <br />
                                <span
                                    style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Pelaporan</span>
                            </a>
                            <a class="category" style="cursor: pointer"><i
                                    class="fa-solid card-menu fa-person-chalkboard text--primary mb-2"
                                    style="font-size: 35px;"></i>
                                <br />
                                <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Bimbingan
                                </span>
                            </a>
                            <a class="category" style="cursor: pointer"><i
                                    class="fa-solid card-menu fa-triangle-exclamation text--primary mb-2"
                                    style="font-size: 35px;"></i>
                                <br />
                                <span
                                    style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Peraturan</span>
                            </a>
                            <a class="category" style="cursor: pointer"><i
                                    class="fa-solid card-menu fa-info text--primary mb-2" style="font-size: 35px;"></i>
                                <br />
                                <span
                                    style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Informasi</span>
                            </a>
                        </div>
                    </div>
                </div>
            </center>
            <div class="container py-3">
                <div class="container">
                    <h5 class="text-center text--primary mb-4 mt-5">Konten Instagram</h5>
                    <div class="row">
                        @foreach ($posts as $index => $post)
                            <div class="col-md-3 mb-3 post-item {{ $index >= 8 ? 'd-none' : '' }}">
                                <div class="card shadow border-0" style="border-radius: 20px">
                                    <div class="card-body">
                                        @if ($post['media_type'] === 'IMAGE')
                                            <img src="{{ $post['media_url'] }}" class="card-img-top"
                                                style="border-radius: 10px; height: 300px;">
                                        @elseif ($post['media_type'] === 'VIDEO')
                                            <video controls style="width: 100%; height: 300px;">
                                                <source src="{{ $post['media_url'] }}" type="video/mp4">
                                            </video>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{ Str::limit($post['caption'], 30) }}.</p>
                                        <a href="{{ $post['permalink'] }}" target="_blank"
                                            class="btn btn-primary gradient-btn">Show Content</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- @if (count($posts) > 8)
                        <a href="/instagram" class="btn btn-primary gradient-btn floar-right" style="width: 150px"> lihat
                            semua</a>
                    @endif --}}
                </div>
            </div>
        </div>

        <style>
            td {
                font-weight: 400;
                font-size: 14px;
            }

            .select-date {
                background: rgb(255, 191, 0);
                border-radius: 30px;
                text-align: center;
                padding: 10px;
                font-weight: bold;
            }

            .sudah-terlaksana {
                border-radius: 5px;
                color: white;
                background: rgb(18, 44, 147);
                padding: 10px;
            }
        </style>
        <section id="recent-blog-posts" class="recent-blog-posts">
            <div class="container" data-aos="fade-up">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8">
                                {{-- <h3 class="mt-3"><b>2023</b></h3> --}}
                            </div>
                            <div class="col-md-4">
                                <div style="font-size: 12px;">Pilih Tahun</div>
                                <form action="#" method="POST">
                                    <table style="width: 100%">
                                        <tr>
                                            <td>
                                                @csrf
                                                <select name="year" class="form-select " style="width: 100%">
                                                    <option value="">-- pilih tahun --</option>
                                                    {{-- <option value="2022">2022</option>
                                                    <option value="2023">2023</option> --}}
                                                    <option value="2024">2024</option>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td><button type="submit" class="btn btn-primary btn-sm">Cari</button></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center">Nama Kegiatan</th>
                                        <th colspan="12" class="text-center">Pelaksanaan</th>
                                        <th rowspan="2" class="text-center">Tanggal</th>
                                        <th rowspan="2" class="text-center">Waktu</th>
                                        <th rowspan="2" class="text-center">Status</th>
                                    </tr>
                                    <tr>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>Mei</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Ags</th>
                                        <th>Sep</th>
                                        <th>Okt</th>
                                        <th>Nov</th>
                                        <th>Des</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kalender as $item)
                                        @php
                                            $bulan = \Carbon\Carbon::parse($item->waktu_kegiatan)->format('n'); // Mendapatkan bulan (1-12)
                                            $tanggal = \Carbon\Carbon::parse($item->waktu_kegiatan)->format('d'); // Mendapatkan tanggal (01-31)
                                        @endphp
                                        <tr>
                                            <td>{{ $item->nama_kegiatan }}</td>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <td class="text-center">
                                                    @if ($i == $bulan)
                                                        <div class="select-date">{{ $tanggal }}</div>
                                                    @endif
                                                </td>
                                            @endfor
                                            <td>{{ \Carbon\Carbon::parse($item->waktu_kegiatan)->format('Y-m-d') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($item->waktu_kegiatan)->format('H:i') }}
                                            </td>
                                            <td>
                                                <div
                                                    class="{{ $item->status == 0 ? 'btn btn-secondary btn-sm' : 'btn btn-primary btn-sm' }}">
                                                    {{ $item->status == 1 ? 'Sudah Terlaksana' : 'Belum Terlaksana' }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- <div style="background: white;" class="mt-5">
            <div class="">
                <div class="container">
                    <h3 class=" text--primary" style=""><b>Video</b></h3>
                    <br>
                    <div class="row position-relative">
                        <div class="col">
                            <button class="scroll-btn left" onclick="scrollGalleryLeft()">&#9664;</button>
                            <div class="scrollable-container" id="galleryContainer">
                                @foreach ($video as $item)
                                    <a href="/video/{{ $item->slug }}">
                                        <img src="https://img.youtube.com/vi/{{ $item->link }}/hqdefault.jpg"
                                            style="width: 360px; object-fit: cover; border-radius: 15px; height: 200px; display: inline-block;"
                                            alt="Image 1">
                                    </a>
                                @endforeach
                            </div>
                            <button class="scroll-btn right" onclick="scrollGalleryRight()">&#9654;</button>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div> --}}

        <a href="https://wa.me/{{ $setting->call_us }}" class="whatsapp-float" target="_blank">
            <div class="whatsapp-icon">
                <i class="bi bi-whatsapp"></i>
            </div>
        </a>

        <script>
            function scrollGalleryLeft() {
                document.getElementById('galleryContainer').scrollBy({
                    left: -300, // Adjust this value based on your image width and scroll behavior
                    behavior: 'smooth'
                });
            }

            function scrollGalleryRight() {
                document.getElementById('galleryContainer').scrollBy({
                    left: 300, // Adjust this value based on your image width and scroll behavior
                    behavior: 'smooth'
                });
            }
        </script>




    </main><!-- End #main -->
@endsection
