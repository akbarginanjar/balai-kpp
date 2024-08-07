<?php

namespace App\Http\Controllers;

use App\Models\Tb_keuntungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbKeuntunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keuntungan = Tb_keuntungan::find(1);
        return view('admin.keuntungan.index', compact('keuntungan'));
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
     * @param  \App\Models\Tb_keuntungan  $tb_keuntungan
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_keuntungan $tb_keuntungan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_keuntungan  $tb_keuntungan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_keuntungan $tb_keuntungan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_keuntungan  $tb_keuntungan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'gambar' => 'image|max:2048',
            'teks1' => 'required',
            'teks2' => 'required',
            'teks3' => 'required',
            'teks4' => 'required',
            'teks5' => 'required',
            'teks6' => 'required',
        ];

        $message = [
            'required' => 'Data wajib diisi!',
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put(
                'danger',
                'Data yang anda input tidak valid, silahkan di ulang'
            );
            return back()
                ->withErrors($validation)
                ->withInput();
        }
        $keuntungan = Tb_keuntungan::findOrFail($id);
        if ($request->hasFile('gambar')) {
            $keuntungan->deletegambar();
            $image = $request->gambar;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/keuntungan/gambar/', $name);
            $keuntungan->gambar = $name;
        }
        $keuntungan->teks1 = $request->teks1;
        $keuntungan->teks2 = $request->teks2;
        $keuntungan->teks3 = $request->teks3;
        $keuntungan->teks4 = $request->teks4;
        $keuntungan->teks5 = $request->teks5;
        $keuntungan->teks6 = $request->teks6;
        $keuntungan->save();
        session()->put('success', 'Data Berhasil Di Simpan');
        return redirect('master-admin/keuntungan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_keuntungan  $tb_keuntungan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_keuntungan $tb_keuntungan)
    {
        //
    }
}