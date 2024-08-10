@extends('layouts.admin')
@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h1 class="text-white pb-2 fw-bold">Module</h1>
                    <h3 class="text-white op-7 mb-2">Module ini adalah module yang dapat dipakai di halaman ataupun mengatur
                        halaman</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <a href="/master-admin/artikel" style="text-decoration: none">
                    <div class="card card-stats card-round d-block bg-info-gradient">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center text-white">
                                        <i class="fa-solid fa-newspaper"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <h1 class="card-title text-white">Artikel</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="/master-admin/slide" style="text-decoration: none">
                    <div class="card card-stats card-round d-block bg-info-gradient">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center text-white">
                                        <i class="fa-solid fa-clone"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers ">
                                        <h1 class="card-title text-white">Slide</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="/master-admin/galeri" style="text-decoration: none">
                    <div class="card card-stats card-round d-block bg-info-gradient">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center text-white">
                                        <i class="fa-regular fa-images"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <h1 class="card-title text-white">Galeri</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="/master-admin/kontak" style="text-decoration: none">
                    <div class="card card-stats card-round d-block bg-info-gradient">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center text-white">
                                        <i class="fa-solid fa-address-book"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <h1 class="card-title text-white">Kontak</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{-- <div class="col-sm-6 col-md-3">
                <a href="/master-admin/tentang" style="text-decoration: none">
                    <div class="card card-stats card-round d-block bg-info-gradient">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="icon-big text-center text-white">
                                        <i class="fa-solid fa-info"></i>
                                    </div>
                                </div>
                                <div class="col-8 col-stats">
                                    <div class="numbers">
                                        <h1 class="card-title text-white">Tentang Kami</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div> --}}
            <!--<div class="col-sm-6 col-md-3">-->
            <!--    <a href="/master-admin/keuntungan" style="text-decoration: none">-->
            <!--        <div class="card card-stats card-round d-block bg-info-gradient">-->
            <!--            <div class="card-body">-->
            <!--                <div class="row">-->
            <!--                    <div class="col-3">-->
            <!--                        <div class="icon-big text-center text-white">-->
            <!--                            <i class="fa-solid fa-check"></i>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <div class="col-9 col-stats">-->
            <!--                        <div class="numbers">-->
            <!--                            <h1 class="card-title text-white">Keuntungan Berlangganan</h2>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </a>-->
            <!--</div>-->
            <div class="col-sm-6 col-md-3">
                <a href="/master-admin/pertanyaan" style="text-decoration: none">
                    <div class="card card-stats card-round d-block bg-info-gradient">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center text-white">
                                        <i class="fa-solid fa-question"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <h1 class="card-title text-white">Pertanyaan</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!--<div class="col-sm-6 col-md-3">-->
            <!--    <a href="/master-admin/produk" style="text-decoration: none">-->
            <!--        <div class="card card-stats card-round d-block bg-info-gradient">-->
            <!--            <div class="card-body">-->
            <!--                <div class="row">-->
            <!--                    <div class="col-5">-->
            <!--                        <div class="icon-big text-center text-white">-->
            <!--                            <i class="fa-solid fa-cube"></i>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <div class="col-7 col-stats">-->
            <!--                        <div class="numbers">-->
            <!--                            <h1 class="card-title text-white">Produk</h2>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </a>-->
            <!--</div>-->
            <!--<div class="col-sm-6 col-md-3">-->
            <!--    <a href="/master-admin/tentangkami" style="text-decoration: none">-->
            <!--        <div class="card card-stats card-round d-block bg-info-gradient">-->
            <!--            <div class="card-body">-->
            <!--                <div class="row">-->
            <!--                    <div class="col-5">-->
            <!--                        <div class="icon-big text-center text-white">-->
            <!--                            <i class="fa-solid fa-info"></i>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <div class="col-7 col-stats">-->
            <!--                        <div class="numbers">-->
            <!--                            <h1 class="card-title text-white">Tentang Kami</h2>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </a>-->
            <!--</div>-->
            <div class="col-sm-6 col-md-3">
                <a href="/master-admin/video" style="text-decoration: none">
                    <div class="card card-stats card-round d-block bg-info-gradient">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center text-white">
                                        <i class="fa-solid fa-video"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <h1 class="card-title text-white">Video</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="/master-admin/faq" style="text-decoration: none">
                    <div class="card card-stats card-round d-block bg-info-gradient">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center text-white">
                                        <i class="fa-solid fa-book"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <h1 class="card-title text-white">FAQ</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{-- <div class="col-sm-6 col-md-3">
                <a href="/master-admin/subscribe" style="text-decoration: none">
                    <div class="card card-stats card-round d-block bg-info-gradient">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center text-white">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <h1 class="card-title text-white">Subscribe</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div> --}}
            <div class="col-sm-6 col-md-3">
                <a href="/master-admin/ebook" style="text-decoration: none">
                    <div class="card card-stats card-round d-block bg-info-gradient">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center text-white">
                                        <i class="fa-solid fa-book"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <h1 class="card-title text-white">E-book</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="/master-admin/kalender-kegiatan" style="text-decoration: none">
                    <div class="card card-stats card-round d-block bg-info-gradient">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center text-white">
                                        <i class="fa-solid fa-book"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <h1 class="card-title text-white">Kalender Kegiatan</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    {{-- <div class="page-inner bg-primary-gradient">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <a href="/master-admin/artikel" style="display: inline-block; text-decoration:none;">
                    <div class="card card-stats card-round d-block">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center text-dark">
                                        <i class="fa-solid fa-newspaper"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <h1 class="card-title">Artikel</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="/master-admin/slide" style="display: inline-block; text-decoration:none;">
                    <div class="card card-stats card-round d-block">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center text-dark">
                                        <i class="fa-solid fa-clone"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers ">
                                        <h1 class="card-title">Slide</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="/master-admin/galeri" style="display: inline-block; text-decoration:none;">
                    <div class="card card-stats card-round d-block">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center text-dark">
                                        <i class="fa-regular fa-images"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <h1 class="card-title">Galeri</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="/master-admin/kontak" style="display: inline-block; text-decoration:none;">
                    <div class="card card-stats card-round d-block">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center text-dark">
                                        <i class="fa-solid fa-address-book"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <h1 class="card-title">Kontak</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div> --}}
@endsection
