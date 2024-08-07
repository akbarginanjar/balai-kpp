@extends('layouts.member')

@section('content')
    <div class="container mt-5">
        <h3>Detail Peta</h3>
        <div class="row wow fadeInUp" data-wow-delay="0.5s">
            <div class="col-lg-7">
                <div class="mt-3" id="mapid"></div>
            </div>
            <div class="col">
                <div class="card border-0">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Wilayah</td>
                                <td></td>
                                <td>{{ old('kab_kota', $peta->wilayah->nama_wilayah) }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td></td>
                                <td>{{ old('alamat', $peta->alamat) }}</td>
                            </tr>
                            <tr>
                                <td>Latitude</td>
                                <td></td>
                                <td>{{ old('latitude', $peta->latitude) }}</td>
                            </tr>
                            <tr>
                                <td>Longitude</td>
                                <td></td>
                                <td>{{ old('longitude', $peta->longitude) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-5">Wilayah {{ old('kab_kota', $peta->wilayah->nama_wilayah) }}</h3>
        <hr>
        <div class="row g-4 mt-2">
            <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item p-4" style="height: cover;">
                    <h5>Kejadian Kebakaran</h5>
                    Jumlah Kejadian : <b>{{ $kejadianKebakaran->jml_kejadian }}</b> <br>
                    Jenis Objek : <ul>
                        @foreach ($jenisTerbakar as $item)
                            <li>{{ $item->nama }} : {{ $item->jumlah }}</li>
                        @endforeach
                    </ul>
                    Penyebab : <ul>
                        @foreach ($jenisTerbakar as $item)
                            <li>{{ $item->nama }} Penyebabnya {{ $item->penyebab }}</li>
                            <ul>
                                <li>Asumsi Kerugian : {{ $item->asumsi_kerugian }}</li>
                                <li>Asumsi Pemadaman : {{ $item->asumsi_pemadaman }}</li>
                            </ul>
                        @endforeach
                    </ul>
                    Total Asumsi Kerugian : <b>{{ $kejadianKebakaran->asumsi_rugi }}</b> <br>
                    Total Asumsi Pemadaman : <b>{{ $kejadianKebakaran->asumsi_selamat }}</b> <br>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item p-4" style="height: cover;">
                    <h5>Kejadian Penyelamatan</h5>
                    Jenis Penyelamatan : <ul>
                        @foreach ($jenisPenyelamatan as $item)
                            <li>{{ $item->nama }}</li>
                        @endforeach
                    </ul>
                    Jumlah : <ul>
                        @foreach ($jenisPenyelamatan as $item)
                            <li>{{ $item->nama }} : {{ $item->jumlah }}</li>
                        @endforeach
                    </ul>
                    Total Jumlah Penyelamatan : <b>{{ $kejadianPenyelamatan->total_selamat }}</b> <br>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2 ">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item p-4" style="height: cover;">
                    <h5>Kerjasama Daerah</h5>
                    Jenis Regulasi : <ul>
                        @foreach ($jenisKdRegulasi as $item)
                            <li>{{ $item->nama }}</li>
                        @endforeach
                    </ul>
                    Jenis SOP : <ul>
                        @foreach ($jenisKdSop as $item)
                            <li>{{ $item->nama }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item p-4" style="height: cover;">
                    <h5>SDM</h5>
                    <div>
                        Total : <b>{{ $sdm->total }}</b> <br>
                        PNS : <b>{{ $sdm->pns }}</b> <br>
                        Non PNS : <b>{{ $sdm->non_pns }}</b> <br>
                        Jafung Damkar : <b>{{ $sdm->jafung_damkaar }}</b> <br>
                        Jafung Analisis Kebakaran : <b>{{ $sdm->jafung_analis }}</b> <br>
                        Diklat Dari APBD : <b>{{ $sdm->diklat_apbd }}</b> <br>
                        Diklat Dari APBN : <b>{{ $sdm->diklat_apbn }}</b> <br>
                        Jenis Pengembangan : <b>{{ $sdm->jenis }}</b> <br>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="team-item p-4" style="height: cover;">
                    <h5>Kelembagaan</h5>
                    Dinas Mandiri : <b>{{ $kelembagaan->dinas_mandiri }}</b> <br>
                    Bergabung Dengan Satpol PP : <b>{{ $kelembagaan->satpol_pp }}</b> <br>
                    Bergabung Dengan BPBD : <b>{{ $kelembagaan->bpbd }}</b> <br>
                    Tipologi Kelembagaan : <b>{{ $kelembagaan->tipologi_kelembagaan }}</b> <br>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item p-4" style="height: cover;">
                    <h5>Relawan</h5>
                    Jumlah Kecamatan : <b>{{ $relawan->jml_kecamatan }}</b> <br>
                    Jumlah Desa / Kelurahan : <b>{{ $relawan->jml_desa }}</b> <br>
                    Jenis Relawan Yang Ada : <ul>
                        @foreach ($jenisRelawan as $item)
                            <li>{{ $item->nama }}</li>
                        @endforeach
                    </ul>
                    Redkar : <b>{{ $relawan->redkar }}</b> <br>
                    Organisasi Relawan : <b>{{ $relawan->organisasi }}</b> <br>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item p-4" style="height: cover;">
                    <h5>Sarpas</h5>
                    Jumlah Kecamatan : <b>{{ $sarpras->jml_kecamatan }}</b> <br>
                    Jumlah Pos Damkar : <b>{{ $sarpras->jml_pos }}</b> <br>
                    Jenis Kendaraan : <ul>
                        @foreach ($jenisKendaraan as $item)
                            <li>{{ $item->nama }} Jumlahnya {{ $item->jumlah }}</li>
                        @endforeach
                    </ul>
                    Jenis APD : <ul>
                        @foreach ($jenisApd as $item)
                            <li>{{ $item->nama }} Jumlahnya {{ $item->jumlah }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="team-item p-4" style="height: cover;">
                    <h5>Regulasi / SOP</h5>
                    Jenis Regulasi : <ul>
                        @foreach ($jenisRegulasi as $item)
                            <li>{{ $item->nama }}</li>
                        @endforeach
                    </ul>
                    Jenis SOP : <ul>
                        @foreach ($jenisSop as $item)
                            <li>{{ $item->nama }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2 mb-5">
            <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item p-4" style="height: cover;">
                    <h5>SPM</h5>
                    Tahun : <ul>
                        @foreach ($tahunSpm as $item)
                            <li>{{ $item->tahun }} : {{ $item->nilai_spm }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item p-4" style="height: cover;">
                    <h5>Anggaran</h5>
                    Tahun : <ul>
                        @foreach ($tahunAnggaran as $item)
                            <li>{{ $item->tahun }} : {{ $item->anggaran }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br>
@endsection

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />

    <style>
        #mapid {
            height: 300px;
        }
    </style>
@endsection

@section('js')
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
    <script>
        var mapCenter = [{{ $peta->latitude }}, {{ $peta->longitude }}];
        var map = L.map('mapid').setView(mapCenter, {{ config('leaflet.detail_zoom_level') }});

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker(mapCenter).addTo(map);

        function updateMarker(lat, lng) {
            marker
                .setLatLng([lat, lng])
                .bindPopup("Lokasinya :  " + marker.getLatLng().toString())
                .openPopup();
            return false;
        };
    </script>
@endsection
