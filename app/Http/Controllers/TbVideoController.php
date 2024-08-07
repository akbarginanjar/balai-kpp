<?php

namespace App\Http\Controllers;

use App\Models\Tb_video;
use App\Models\Tb_kategori_video;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;

class TbVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video = Tb_video::orderBy('created_at', 'desc')->get();
        
        return view('admin.video.index', compact('video'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoriVideo = Tb_kategori_video::orderBy('created_at', 'desc')->get();
        return view('admin.video.create', compact('kategoriVideo'));
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
            'link' => 'required',
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
        $video = new Tb_video();
        $video->judul = $request->judul;
        $video->link = $request->link;
        $video->id_kategori_video = $request->id_kategori_video;
        $video->tgl_pembuatan = $request->tgl_pembuatan;
        $video->waktu_pembuatan = $request->waktu_pembuatan;
        $video->slug = Str::slug($request->judul);
        $video->deskripsi = $request->deskripsi;
        $video->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect()->route('video.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_video  $tb_video
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_video $tb_video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_video  $tb_video
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Tb_video::findOrFail($id);
        $kategoriVideo = Tb_kategori_video::orderBy('created_at', 'desc')->get();
        return view('admin.video.edit', compact('video', 'kategoriVideo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_video  $tb_video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'judul' => 'required',
            'link' => 'required',
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
        $video = Tb_video::findOrFail($id);
        $video->judul = $request->judul;
        $video->link = $request->link;
        $video->id_kategori_video = $request->id_kategori_video;
        $video->tgl_pembuatan = $request->tgl_pembuatan;
        $video->waktu_pembuatan = $request->waktu_pembuatan;
        $video->slug = Str::slug($request->judul);
        $video->deskripsi = $request->deskripsi;
        $video->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect()->route('video.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_video  $tb_video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Tb_video::findOrFail($id);
        $video->delete();
        session()->put('success', 'Data Berhasil dihapus');
        return redirect()->route('video.index');
    }
}