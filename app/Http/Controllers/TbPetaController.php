<?php

namespace App\Http\Controllers;

use App\Models\Tb_anggaran;
use App\Models\Tb_jenis_apd;
use App\Models\Tb_jenis_kendaraan;
use App\Models\Tb_jenis_penyelamatan;
use App\Models\Tb_jenis_regulasi;
use App\Models\Tb_jenis_relawan;
use App\Models\Tb_jenis_sop;
use App\Models\Tb_jenis_terbakar;
use App\Models\Tb_kd_jenis_regulasi;
use App\Models\Tb_kd_jenis_sop;
use App\Models\Tb_kejadian_kebakaran;
use App\Models\Tb_kejadian_penyelamatan;
use App\Models\Tb_kelembagaan;
use App\Models\Tb_kerjasama_daerah;
use App\Models\Tb_peta;
use App\Models\Tb_regulasi_sop;
use App\Models\Tb_relawan;
use App\Models\Tb_sarpras;
use App\Models\Tb_sdm;
use App\Models\Tb_spm;
use App\Models\Tb_tahun_anggaran;
use App\Models\Tb_tahun_spm;
use App\Models\Tb_wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbPetaController extends Controller
{
    /**
     * Display a listing of the outlet.
     *
     * @return \Illuminate\View\View
     */
    public function geo(Request $request)
    {
        return view('admin.peta.map');
    }

    public function index()
    {

        $peta = Tb_peta::all();

        return view('admin.peta.index', compact('peta'));
    }

    public function detail($id)
    {
        $peta = Tb_peta::find($id);
        // SDM
        $sdm = Tb_sdm::where('id_wilayah', $peta->id_wilayah)->first();
        // Kelembagaan
        $kelembagaan = Tb_kelembagaan::where('id_wilayah', $peta->id_wilayah)->first();
        // Regulasi/SOP
        $regulasiSop = Tb_regulasi_sop::where('id_wilayah', $peta->id_wilayah)->first();
        $jenisRegulasi = Tb_jenis_regulasi::where('id_regulasi', $regulasiSop->id)->get();
        $jenisSop = Tb_jenis_sop::where('id_regulasi', $regulasiSop->id)->get();
        // Relawan
        $relawan = Tb_relawan::where('id_wilayah', $peta->id_wilayah)->first();
        $jenisRelawan = Tb_jenis_relawan::where('id_relawan', $relawan->id)->get();
        // Kejadian Kebakaran
        $kejadianKebakaran = Tb_kejadian_kebakaran::where('id_wilayah', $peta->id_wilayah)->first();
        $jenisTerbakar = Tb_jenis_terbakar::where('id_kejadian_kebakaran', $kejadianKebakaran->id)->get();
        // Kejadian Penyelamatan
        $kejadianPenyelamatan = Tb_kejadian_penyelamatan::where('id_wilayah', $peta->id_wilayah)->first();
        $jenisPenyelamatan = Tb_jenis_penyelamatan::where('id_kejadian_penyelamatan', $kejadianPenyelamatan->id)->get();
        //Kerjasama Daerah
        $kerjasamaDaerah = Tb_kerjasama_daerah::where('id_wilayah', $peta->id_wilayah)->first();
        $jenisKdRegulasi = Tb_kd_jenis_regulasi::where('id_kerjasama_daerah', $kerjasamaDaerah->id)->get();
        $jenisKdSop = Tb_kd_jenis_sop::where('id_kerjasama_daerah', $kerjasamaDaerah->id)->get();
        // Sarpras
        $sarpras = Tb_sarpras::where('id_wilayah', $peta->id_wilayah)->first();
        $jenisKendaraan = Tb_jenis_kendaraan::where('id_sarpras', $sarpras->id)->get();
        $jenisApd = Tb_jenis_apd::where('id_sarpras', $sarpras->id)->get();
        // SPM
        $spm = Tb_spm::where('id_wilayah', $peta->id_wilayah)->first();
        $tahunSpm = Tb_tahun_spm::where('id_spm', $spm->id)->get();
        // Anggaran
        $anggaran = Tb_anggaran::where('id_wilayah', $peta->id_wilayah)->first();
        $tahunAnggaran = Tb_tahun_anggaran::where('id_anggaran', $anggaran->id)->get();
        return view('admin.peta.detail', compact('peta', 'sdm', 'kelembagaan', 'regulasiSop', 'relawan', 'kejadianKebakaran', 'kejadianPenyelamatan', 'kerjasamaDaerah', 'sarpras', 'spm', 'anggaran', 'jenisTerbakar', 'jenisPenyelamatan', 'jenisKdRegulasi', 'jenisKdSop', 'jenisRelawan', 'jenisKendaraan', 'jenisApd', 'jenisRegulasi', 'jenisSop', 'tahunSpm', 'tahunAnggaran'));
    }

    /**
     * Show the form for creating a new Tb_peta().
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $wilayah = Tb_wilayah::all();
        return view('admin.peta.create', compact('wilayah'));
    }

    /**
     * Store a newly created outlet in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $rules = [
            'id_wilayah' => 'required',
            'alamat'   => 'nullable|max:255',
            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ];

        $message = [
            'required' => 'Data wajib diisi!',
            'unique' => 'Data sudah ada!'
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }

        $peta = new Tb_peta();
        $peta->id_wilayah = $request->id_wilayah;
        $peta->alamat = $request->alamat;
        $peta->latitude = $request->latitude;
        $peta->longitude = $request->longitude;
        $peta->save();
        session()->put('success', 'Data Berhasil ditambahkan');

        return redirect()->route('peta.index');
    }

    /**
     * Display the specified outlet.
     *
     * @param  \App\Outlet  $tb_peta
     * @return \Illuminate\View\View
     */
    public function show(Tb_peta $tb_peta)
    {
        return view('admin.peta.show', compact('outlet'));
    }

    /**
     * Show the form for editing the specified outlet.
     *
     * @param  \App\Outlet  $tb_peta
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $peta = Tb_peta::find($id);
        $wilayah = Tb_wilayah::all();
        return view('admin.peta.edit', compact('peta', 'wilayah'));
    }

    /**
     * Update the specified outlet in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outlet  $tb_peta
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'id_wilayah' => 'required',
            'alamat'   => 'nullable|max:255',
            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ];

        $message = [
            'required' => 'Data wajib diisi!',
            'unique' => 'Data sudah ada!'
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }

        $peta = Tb_peta::find($id);
        $peta->id_wilayah = $request->id_wilayah;
        $peta->alamat = $request->alamat;
        $peta->latitude = $request->latitude;
        $peta->longitude = $request->longitude;
        $peta->save();
        session()->put('success', 'Data Berhasil Diedit');

        return redirect()->route('peta.index');
    }

    /**
     * Remove the specified outlet from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outlet  $tb_peta
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        $peta = Tb_peta::find($id);
        $peta->delete();
        return redirect()->route('peta.index');
    }
}
