<?php

namespace App\Http\Controllers;

use App\Models\Tb_kategori_kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TbKategoriKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoriKegiatan = Tb_kategori_kegiatan::all();
        return view('admin.kategori-kegiatan.index', compact('kategoriKegiatan'));
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
            'nama' => 'required|unique:tb_kategori_kegiatans',
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

        $kategoriKegiatan = new Tb_kategori_kegiatan();
        $kategoriKegiatan->nama = $request->nama;
        $kategoriKegiatan->slug = Str::slug($request->nama);
        $kategoriKegiatan->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect()->route('kategori-kegiatan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_kategori_kegiatan  $tb_kategori_kegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_kategori_kegiatan $tb_kategori_kegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_kategori_kegiatan  $tb_kategori_kegiatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_kategori_kegiatan $tb_kategori_kegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_kategori_kegiatan  $tb_kategori_kegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nama' => 'required',
        ];

        $message = [
            'required' => 'Data wajib diisi!',
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }

        $kategoriKegiatan = Tb_kategori_kegiatan::findOrFail($id);
        $kategoriKegiatan->nama = $request->nama;
        $kategoriKegiatan->slug = Str::slug($request->nama);
        $kategoriKegiatan->save();
        session()->put('success', 'Data Berhasil diedit');
        return redirect()->route('kategori-kegiatan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_kategori_kegiatan  $tb_kategori_kegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategoriKegiatan = Tb_kategori_kegiatan::findOrFail($id);
        if (!Tb_kategori_kegiatan::destroy($id)) {
            return redirect()->back();
        } else {
            $kategoriKegiatan->delete();
            session()->put('success', 'Data Berhasil Di Hapus');
            return redirect()->route('kategori-kegiatan.index');
        }
    }
}
