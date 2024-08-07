<?php

namespace App\Http\Controllers;

use App\Models\Tb_kategori_kegiatan;
use App\Models\Tb_kegiatan;
use App\Models\Tb_konten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TbKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kegiatan = Tb_kegiatan::all();
        $kategoriKegiatan = Tb_kategori_kegiatan::all();
        return view('admin.kegiatan.index', compact('kegiatan', 'kategoriKegiatan'));
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
            'judul' => 'required|unique:tb_kegiatans',
            'id_kategori_kegiatan' => 'required',
            'teks' => 'required|min:50',
            'gambar' => 'image|max:2048',
        ];

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
        $kegiatan = new Tb_kegiatan();
        $kegiatan->id_kategori_kegiatan = $request->id_kategori_kegiatan;
        $kegiatan->judul = $request->judul;
        $kegiatan->slug = Str::slug($request->judul);
        $kegiatan->teks = $request->teks;
        if ($request->hasFile('gambar')) {
            $image = $request->gambar;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/kegiatan/', $name);
            $kegiatan->gambar = $name;
        }
        $kegiatan->save();

        $konten = new Tb_konten();
        $konten->id_kegiatan = $kegiatan->id;
        $konten->type = "kegiatan";
        $konten->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect()->route('kegiatan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_kegiatan  $tb_kegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_kegiatan $tb_kegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_kegiatan  $tb_kegiatan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kegiatan = Tb_kegiatan::findOrFail($id);
        $kategoriKegiatan = Tb_kategori_kegiatan::all();
        return view('admin.kegiatan.edit', compact('kegiatan', 'kategoriKegiatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_kegiatan  $tb_kegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'judul' => 'required',
            'id_kategori_kegiatan' => 'required',
            'teks' => 'required|min:50',
            'gambar' => 'image|max:2048',
        ];

        $message = [
            'required' => 'Data wajib diisi!',
            'min' => 'Teks minimal :min karakter'
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $kegiatan = Tb_kegiatan::findOrFail($id);
        $kegiatan->id_kategori_kegiatan = $request->id_kategori_kegiatan;
        $kegiatan->judul = $request->judul;
        $kegiatan->slug = Str::slug($request->judul);
        $kegiatan->teks = $request->teks;
        if ($request->hasFile('gambar')) {
            $kegiatan->deleteGambar();
            $image = $request->gambar;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/kegiatan/', $name);
            $kegiatan->gambar = $name;
        }
        $kegiatan->save();
        session()->put('success', 'Data Berhasil diedit');
        return redirect()->route('kegiatan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_kegiatan  $tb_kegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kegiatan = Tb_kegiatan::findOrFail($id);
        $kegiatan->deleteGambar();
        $kegiatan->delete();

        $kontens = Tb_konten::where('id_kegiatan', $kegiatan->id)->get();
        foreach ($kontens as $kontenb) {
            $kontenb;
        }
        $konten = Tb_konten::find($kontenb->id);
        $konten->delete();
        session()->put('success', 'Data Berhasil dihapus');
        return redirect()->route('kegiatan.index');
    }
}
