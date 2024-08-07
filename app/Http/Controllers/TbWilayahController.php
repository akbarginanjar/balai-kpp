<?php

namespace App\Http\Controllers;

use App\Models\Tb_anggaran;
use App\Models\Tb_kejadian_kebakaran;
use App\Models\Tb_kejadian_penyelamatan;
use App\Models\Tb_kelembagaan;
use App\Models\Tb_kerjasama_daerah;
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
use Illuminate\Support\Str;

class TbWilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wilayah = Tb_wilayah::all();
        return view('admin.user.wilayah.index', compact('wilayah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'kode_wilayah' => 'required',
            'nama_wilayah' => 'required|unique:tb_wilayahs',
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
        $wilayah = new Tb_wilayah();
        $wilayah->kode_wilayah = $request->kode_wilayah;
        $wilayah->nama_wilayah = $request->nama_wilayah;
        $wilayah->save();

        $sdm = new Tb_sdm();
        $sdm->id_wilayah = $wilayah->id;
        $sdm->save();
        $kelembagaan = new Tb_kelembagaan();
        $kelembagaan->id_wilayah = $wilayah->id;
        $kelembagaan->save();
        $relawan = new Tb_relawan();
        $relawan->id_wilayah = $wilayah->id;
        $relawan->save();
        $sarpras = new Tb_sarpras();
        $sarpras->id_wilayah = $wilayah->id;
        $sarpras->save();
        $regulasi_sop = new Tb_regulasi_sop();
        $regulasi_sop->id_wilayah = $wilayah->id;
        $regulasi_sop->save();
        $kejadian_kebakaran = new Tb_kejadian_kebakaran();
        $kejadian_kebakaran->id_wilayah = $wilayah->id;
        $kejadian_kebakaran->save();
        $kejadian_penyelamatan = new Tb_kejadian_penyelamatan();
        $kejadian_penyelamatan->id_wilayah = $wilayah->id;
        $kejadian_penyelamatan->save();
        $kerjasama_daerah = new Tb_kerjasama_daerah();
        $kerjasama_daerah->id_wilayah = $wilayah->id;
        $kerjasama_daerah->save();
        $spm = new Tb_spm();
        $spm->id_wilayah = $wilayah->id;
        $spm->save();
        $spmNow = Tb_spm::first();
        $tahunSpmNow = Tb_tahun_spm::where('id_spm', $spmNow->id)->get();
        if ($tahunSpmNow != null) {
            foreach ($tahunSpmNow as $data) {
                $tahunSpm = new Tb_tahun_spm();
                $tahunSpm->id_spm = $spm->id;
                $tahunSpm->tahun = $data->tahun;
                $tahunSpm->nilai_spm = 0;
                $tahunSpm->save();
            }
        }
        $anggaran = new Tb_anggaran();
        $anggaran->id_wilayah = $wilayah->id;
        $anggaran->save();
        $anggaranNow = Tb_anggaran::first();
        $tahunAnggaranNow = Tb_tahun_anggaran::where('id_anggaran', $anggaranNow->id)->get();
        if ($tahunAnggaranNow != null) {
            foreach ($tahunAnggaranNow as $data) {
                $tahunAnggaran = new Tb_tahun_anggaran();
                $tahunAnggaran->id_anggaran = $anggaran->id;
                $tahunAnggaran->tahun = $data->tahun;
                $tahunAnggaran->anggaran = 0;
                $tahunAnggaran->save();
            }
        }
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect()->route('wilayah.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_wilayah  $tb_wilayah
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_wilayah $tb_wilayah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_wilayah  $tb_wilayah
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_wilayah $tb_wilayah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_wilayah  $tb_wilayah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'kode_wilayah' => 'required',
            'nama_wilayah' => 'required',
        ];

        $message = [
            'required' => 'Data wajib diisi!'
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $wilayah = Tb_wilayah::findOrFail($id);
        $wilayah->kode_wilayah = $request->kode_wilayah;
        $wilayah->nama_wilayah = $request->nama_wilayah;
        $wilayah->save();
        session()->put('success', 'Data Berhasil diedit');
        return redirect()->route('wilayah.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_wilayah  $tb_wilayah
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wilayah = Tb_wilayah::findOrFail($id);
        if (!Tb_wilayah::destroy($id)) {
            return redirect()->back();
        } else {
            $wilayah->delete();
            session()->put('success', 'Data Berhasil Di Hapus');
            return redirect()->route('wilayah.index');
        }
    }
}
