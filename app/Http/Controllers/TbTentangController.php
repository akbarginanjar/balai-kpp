<?php

namespace App\Http\Controllers;

use App\Models\Tb_tentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbTentangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tentang = Tb_tentang::find(1);
        return view('admin.tentang.index', compact('tentang'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_tentang  $tb_tentang
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_tentang $tb_tentang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_tentang  $tb_tentang
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_tentang $tb_tentang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_tentang  $tb_tentang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'gambar' => 'image|max:2048',
            'judul' => 'required',
            'teks' => 'required',
        ];

        $message = [
            'required' => 'Data wajib diisi!',
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $tentang = Tb_tentang::findOrFail($id);
        if ($request->hasFile('gambar')) {
            $tentang->deletegambar();
            $image = $request->gambar;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/tentang/gambar/', $name);
            $tentang->gambar = $name;
        }
        $tentang->judul = $request->judul;
        $tentang->teks = $request->teks;
        $tentang->save();
        session()->put('success', 'Data Berhasil Di Simpan');
        return redirect('admin/tentang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_tentang  $tb_tentang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_tentang $tb_tentang)
    {
        //
    }
}
