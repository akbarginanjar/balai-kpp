<?php

namespace App\Http\Controllers;

use App\Models\Tb_ebook;
use App\Models\Tb_kategori_ebook;
use App\Models\Tb_kategori_konten_ebook;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;

class TbEbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ebook = Tb_ebook::orderBy('created_at', 'desc')->get();
        return view('admin.ebook.index', compact('ebook'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoriEbook = Tb_kategori_ebook::all();
        $kategoriKontenEbook = Tb_kategori_konten_ebook::all();
        return view('admin.ebook.create', compact('kategoriEbook', 'kategoriKontenEbook'));
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
            'judul' => 'required',
            'id_kategori_ebook' => 'required',
            // 'teks' => 'required',
            'gambar' => 'nullable',
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
        $ebook = new Tb_ebook();
        $ebook->id_kategori_ebook = $request->id_kategori_ebook;
        $ebook->id_kategori_konten_ebook = $request->id_kategori_konten_ebook;
        $ebook->id_user = Auth::user()->id;
        $ebook->judul = $request->judul;
        $ebook->tgl_pembuatan = $request->tgl_pembuatan;
        $ebook->waktu_pembuatan = $request->waktu_pembuatan;
        $ebook->slug = Str::slug($request->judul);
        $ebook->teks = $request->teks;
        $ebook->link = $request->link;
        $ebook->viewer = 0;
        if ($request->hasFile('gambar')) {
            $image = $request->gambar;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/ebook/', $name);
            $ebook->gambar = $name;
        }
        if ($request->hasFile('file')) {
            $image = $request->file;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/ebook/file/', $name);
            $ebook->file = $name;
        }
        $ebook->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect()->route('ebook.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_ebook  $tb_ebook
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_ebook $tb_ebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_ebook  $tb_ebook
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ebook = Tb_ebook::findOrFail($id);
        $kategoriEbook = Tb_kategori_ebook::all();
        $kategoriKontenEbook = Tb_kategori_konten_ebook::all();
        return view('admin.ebook.edit', compact('ebook', 'kategoriEbook', 'kategoriKontenEbook'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_ebook  $tb_ebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'judul' => 'required',
            'id_kategori_ebook' => 'required',
            // 'teks' => 'required',
            'gambar' => 'nullable',
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
        $ebook = Tb_ebook::findOrFail($id);
        $ebook->id_kategori_ebook = $request->id_kategori_ebook;
        $ebook->id_kategori_konten_ebook = $request->id_kategori_konten_ebook;
        $ebook->judul = $request->judul;
        $ebook->tgl_pembuatan = $request->tgl_pembuatan;
        $ebook->waktu_pembuatan = $request->waktu_pembuatan;
        $ebook->slug = Str::slug($request->judul);
        $ebook->teks = $request->teks;
        $ebook->link = $request->link;
        if ($request->hasFile('gambar')) {
            $ebook->deleteGambar();
            $image = $request->gambar;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/ebook/', $name);
            $ebook->gambar = $name;
        }
        if ($request->hasFile('file')) {
            $image = $request->file;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/ebook/file/', $name);
            $ebook->file = $name;
        }
        $ebook->save();
        session()->put('success', 'Data Berhasil diedit');
        return redirect()->route('ebook.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_ebook  $tb_ebook
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ebook = Tb_ebook::findOrFail($id);
        $ebook->deleteGambar();
        $ebook->delete();
        session()->put('success', 'Data Berhasil dihapus');
        return redirect()->route('ebook.index');
    }
}