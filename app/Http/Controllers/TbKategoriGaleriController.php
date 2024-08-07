<?php

namespace App\Http\Controllers;

use App\Models\Tb_kategori_galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TbKategoriGaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoriGaleri = Tb_kategori_galeri::all();
        return view('admin.kategori-galeri.index', compact('kategoriGaleri'));
    }

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
            'nama' => 'required|unique:tb_kategori_galeris',
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
        $kategoriGaleri = new Tb_kategori_galeri();
        $kategoriGaleri->nama = $request->nama;
        $kategoriGaleri->slug = Str::slug($request->nama);
        if ($request->hasFile('cover')) {
            $image = $request->cover;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/kategoriGaleri/', $name);
            $kategoriGaleri->cover = $name;
        }
        $kategoriGaleri->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect()->route('kategori-galeri.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_kategori_galeri  $tb_kategori_galeri
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_kategori_galeri $tb_kategori_galeri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_kategori_galeri  $tb_kategori_galeri
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_kategori_galeri $tb_kategori_galeri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_kategori_galeri  $tb_kategori_galeri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nama' => 'required',
        ];

        $message = [
            'required' => 'Data wajib diisi!'
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $kategoriGaleri = Tb_kategori_galeri::findOrFail($id);
        $kategoriGaleri->nama = $request->nama;
        $kategoriGaleri->slug = Str::slug($request->nama);
        if ($request->hasFile('cover')) {
            $kategoriGaleri->deletecover();
            $image = $request->cover;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/kategoriGaleri/', $name);
        }
        $kategoriGaleri->save();
        session()->put('success', 'Data Berhasil diedit');
        return redirect()->route('kategori-galeri.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_kategori_galeri  $tb_kategori_galeri
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategoriGaleri = Tb_kategori_galeri::findOrFail($id);
        if (!Tb_kategori_galeri::destroy($id)) {
            return redirect()->back();
        } else {
            $kategoriGaleri->delete();
            session()->put('success', 'Data Berhasil Di Hapus');
            return redirect()->route('kategori-galeri.index');
        }
    }
}
