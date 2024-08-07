<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tb_kategori_video;
use Validator;
use Str;
use DB;

class TbKategoriVideoController extends Controller
{
    public function index()
    {
        $kategoriVideo = Tb_kategori_video::all();
        return view('admin.kategori-video.index', compact('kategoriVideo'));
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
            'nama' => 'required',
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
        $kategoriVideo = new Tb_kategori_video();
        $kategoriVideo->nama = $request->nama;
        $kategoriVideo->slug = Str::slug($request->nama);
        $kategoriVideo->save();

        // $konten = new Tb_konten();
        // $konten->id_kategori_ebook = $kategoriVideo->id;
        // $konten->type = "kategori-ebook";
        // $konten->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect()->route('kategori-video.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_kategori_video  $tb_kategori_video
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_kategori_video $tb_kategori_video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_kategori_video  $tb_kategori_video
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_kategori_video  $tb_kategori_video
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
        $kategoriVideo = Tb_kategori_video::findOrFail($id);
        $kategoriVideo->nama = $request->nama;
        $kategoriVideo->slug = Str::slug($request->nama);
        $kategoriVideo->save();
        session()->put('success', 'Data Berhasil diedit');
        return redirect()->route('kategori-video.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_kategori_video  $tb_kategori_video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategoriVideo = Tb_kategori_video::findOrFail($id);
        if (!Tb_kategori_video::destroy($id)) {
            return redirect()->back();
        } else {
            $kategoriVideo->delete();
            session()->put('success', 'Data Berhasil Di Hapus');
            return redirect()->route('kategori-video.index');
        }
    }
}
