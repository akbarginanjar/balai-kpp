<?php

namespace App\Http\Controllers;

use App\Models\Tb_halaman;
use App\Models\Tb_konten;
use App\Models\Tb_kategori_konten;
use App\Models\Tb_kategori_konten_ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TbHalamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $halaman = Tb_halaman::all();
        return view('admin.halaman.index', compact('halaman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoriKonten = Tb_kategori_konten::all();
        $kategoriKontenEbook = Tb_kategori_konten_ebook::all();
        return view('admin.halaman.create', compact('kategoriKonten', 'kategoriKontenEbook'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [];

        $message = [
            'required' => 'Data wajib diisi!',
            'unique' => 'Data sudah ada!',
            'min' => 'Teks minimal :min karakter'
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $halaman = new Tb_halaman();
        $halaman->judul = $request->judul;
        $halaman->slug = Str::slug($request->judul);
        $halaman->teks = $request->teks;
        if ($request->hasFile('gambar')) {
            $image = $request->gambar;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/halaman/', $name);
            $halaman->gambar = $name;
        }

        $halaman->atas_kiri = $request->atas_kiri;
        $halaman->atas_tengah = $request->atas_tengah;
        $halaman->atas_kanan = $request->atas_kanan;
        $halaman->tengah_kiri = $request->tengah_kiri;
        $halaman->tengah = $request->tengah;
        $halaman->tengah_kanan = $request->tengah_kanan;
        $halaman->bawah_kiri = $request->bawah_kiri;
        $halaman->bawah_tengah = $request->bawah_tengah;
        $halaman->bawah_kanan = $request->bawah_kanan;
        $halaman->save();

        $konten = new Tb_konten();
        $konten->id_halaman = $halaman->id;
        $konten->type = "halaman";
        $konten->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect()->route('halaman.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_halaman  $tb_halaman
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_halaman $tb_halaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_halaman  $tb_halaman
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategoriKonten = Tb_kategori_konten::all();
        $kategoriKontenEbook = Tb_kategori_konten_ebook::all();
        $halaman = Tb_halaman::findOrFail($id);
        return view('admin.halaman.edit', compact('halaman', 'kategoriKonten', 'kategoriKontenEbook'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_halaman  $tb_halaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [];

        $message = [
            'required' => 'Data wajib diisi!',
            'min' => 'Teks minimal :min karakter'
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $halaman = Tb_halaman::findOrFail($id);
        $halaman->judul = $request->judul;
        $halaman->slug = Str::slug($request->judul);
        $halaman->teks = $request->teks;
        if ($request->hasFile('gambar')) {
            $halaman->deleteGambar();
            $image = $request->gambar;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/halaman/', $name);
            $halaman->gambar = $name;
        }
        $halaman->atas_kiri = $request->atas_kiri;
        $halaman->atas_tengah = $request->atas_tengah;
        $halaman->atas_kanan = $request->atas_kanan;
        $halaman->tengah_kiri = $request->tengah_kiri;
        $halaman->tengah = $request->tengah;
        $halaman->tengah_kanan = $request->tengah_kanan;
        $halaman->bawah_kiri = $request->bawah_kiri;
        $halaman->bawah_tengah = $request->bawah_tengah;
        $halaman->bawah_kanan = $request->bawah_kanan;
        $halaman->save();

        session()->put('success', 'Data Berhasil diedit');
        return redirect()->route('halaman.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_halaman  $tb_halaman
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $halaman = Tb_halaman::findOrFail($id);
        $halaman->deleteGambar();
        $halaman->delete();

        $kontens = Tb_konten::where('id_halaman', $halaman->id)->get();
        foreach ($kontens as $kontenb) {
            $kontenb;
        }
        $konten = Tb_konten::find($kontenb->id);
        $konten->delete();
        session()->put('success', 'Data Berhasil dihapus');
        return redirect()->route('halaman.index');
    }
}