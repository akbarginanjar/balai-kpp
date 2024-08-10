<div>
    @php
        use App\Models\KalenderKegiatan;
    
        $year_all = KalenderKegiatan::orderBy('created_at', 'asc')->get()->pluck('waktu_kegiatan')
            ->map(function ($date) {
                return date('Y', strtotime($date));
            })->unique()->values();
        

        $selected_year = request()->get('year');

      
        $kalender = KalenderKegiatan::query()
            ->when($selected_year, function ($query, $year) {
                return $query->whereYear('waktu_kegiatan', $year);
            })
            ->orderBy('created_at', 'asc')
            ->get();
    @endphp

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
        <div class="" data-aos="fade-up">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            {{-- <h3 class="mt-3"><b>2023</b></h3> --}}
                        </div>
                        <div class="col-md-4">
                            <div style="font-size: 12px;">Pilih Tahun</div>
                            <form action="{{ url()->current() }}" method="GET">
                                <table style="width: 100%">
                                    <tr>
                                        <td>
                                            <select name="year" class="form-select " style="width: 100%">
                                                <option value="">-- pilih tahun --</option>
                                                @foreach ($year_all as $item)
                                                     <option value="{{ $item }}" {{ $item == $selected_year ? 'selected' : '' }}>{{ $item }}</option>     
                                                @endforeach
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
                                        <td>{{ \Carbon\Carbon::parse($item->waktu_kegiatan)->format('Y-m-d') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->waktu_kegiatan)->format('H:i') }}</td>
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
</div>
