@extends('layouts.admin')


@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Peta</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="/admin/dashboard">
                        <i class="fa-solid fa-house-chimney"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="/admin/peta">Peta</a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="">Edit Peta</a>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-header">Edit Peta</div>
            <form method="POST" action="{{ route('peta.update', $peta->id) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
                <div class="card-body">
                    <div class="form-group">
                        <label>Wilayah</label>
                        <div class="input-group ">

                            <select name="id_wilayah" required class="form-control form-control"
                                @error('id_wilayah') is-invalid @enderror>
                                <option value="">-- Pilih Wilayah --</option>
                                @foreach ($wilayah as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $peta->id_wilayah == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_wilayah }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_wilayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="control-label">Alamat</label>
                        <textarea id="alamat" class="form-control" name="alamat" rows="4" @error('alamat') is-invalid @enderror>{{ old('alamat', $peta->alamat) }}</textarea>
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="latitude" class="control-label">Latitude</label>
                                <input id="latitude" type="text" class="form-control" name="latitude"
                                    value="{{ old('latitude', $peta->latitude) }}" required
                                    @error('latitude') is-invalid @enderror>
                                @error('latitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="longitude" class="control-label">Longitude</label>
                                <input id="longitude" type="text" class="form-control" name="longitude"
                                    value="{{ old('longitude', $peta->longitude) }}" required
                                    @error('longitude') is-invalid @enderror>
                                @error('longitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div id="mapid"></div>
                    <div class="form-group mt-3">
                        <input type="submit" value="Simpan Perubahan" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
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
                .bindPopup("Lokasi Anda :  " + marker.getLatLng().toString())
                .openPopup();
            return false;
        };

        map.on('click', function(e) {
            let latitude = e.latlng.lat.toString().substring(0, 15);
            let longitude = e.latlng.lng.toString().substring(0, 15);
            $('#latitude').val(latitude);
            $('#longitude').val(longitude);
            updateMarker(latitude, longitude);
        });

        var updateMarkerByInputs = function() {
            return updateMarker($('#latitude').val(), $('#longitude').val());
        }
        $('#latitude').on('input', updateMarkerByInputs);
        $('#longitude').on('input', updateMarkerByInputs);
    </script>
@endsection
