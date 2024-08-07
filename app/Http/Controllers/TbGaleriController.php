<?php

namespace App\Http\Controllers;

use App\Models\Tb_galeri;
use App\Models\Tb_kategori_galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbGaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galeri = Tb_galeri::orderBy('created_at', 'asc')->get();
        $kategoriGaleri = Tb_kategori_galeri::all();
        return view('admin.galeri.index', compact('galeri', 'kategoriGaleri'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tb_galeri $tb_galeri)
    {
        $galeri = Tb_galeri::find($tb_galeri->id);
        return view('admin.galeri.create', compact('galeri'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tb_galeri $tb_galeri)
    {
        // $request->validate([
        //     'gambar' => 'required',
        // ]);

        $rules = [
            'id_kategori_galeri' => 'required',
            'gambar' => 'required',
        ];

        $message = [
            'gambar.required' => 'gambar harus di isi',
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }

        if ($request->hasfile('gambar')) {
            $files = [];
            foreach ($request->file('gambar') as $file) {
                if ($file->isValid()) {
                    $gambar = rand(1000, 9999) . $file->getClientOriginalName();
                    $file->move(public_path('images/galeri/'), $gambar);
                    $files[] = [
                        'id_kategori_galeri' => $request->id_kategori_galeri,
                        'gambar' => $gambar,
                        'created_at' => date('Y-m-d'),
                        'updated_at' => date('Y-m-d'),
                    ];
                }
            }
            Tb_galeri::insert($files);
        }
        session()->put('success', 'Data Berhasil Di Tambahkan');
        return redirect()->route('galeri.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_galeri  $tb_galeri
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_galeri $tb_galeri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_galeri  $tb_galeri
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_galeri $tb_galeri, $id)
    {
        $galeri = Tb_galeri::find($tb_galeri->id);
        $galeri = Tb_galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('galeri', 'galeri'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_galeri  $tb_galeri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_galeri $tb_galeri, $id)
    {
        $rules = [
            'id_kategori_galeri' => 'required',
            'gambar' => 'required',
        ];

        $message = [
            'gambar.required' => 'gambar harus di isi',
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $galeri = Tb_galeri::findOrFail($id);
        $galeri->id_kategori_galeri = $request->id_kategori_galeri;
        if ($request->hasFile('gambar')) {
            $galeri->deleteGambar();
            $image = $request->gambar;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/galeri/', $name);
            $galeri->gambar = $name;
        }
        $galeri->save();
        session()->put('success', 'Data Berhasil Di Edit');
        return redirect()->route('galeri.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_galeri  $tb_galeri
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $galeri = Tb_galeri::findOrFail($id);
        $galeri->deleteGambar();
        $galeri->delete();
        session()->put('success', 'Data Berhasil Di Hapus');
        return redirect()->back();
    }
}
