<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::all();
        return view('admin.produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.produk.create');
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
            'deskripsi' => 'required|min:50',
            'cover' => 'nullable|image|max:2048',
        ];

        $message = [
            'required' => 'Data wajib diisi!',
            'unique' => 'Data sudah ada!',
            'min' => 'Teks minimal :min karakter',
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
        $produk = new Produk();
        $produk->nama = $request->nama;
        $produk->slug = Str::slug($request->nama);
        $produk->deskripsi = $request->deskripsi;
        if ($request->hasFile('cover')) {
            $image = $request->cover;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/produk/', $name);
            $produk->cover = $name;
        }
        $produk->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect('/admin/produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nama' => 'required',
            'deskripsi' => 'required|min:50',
            'cover' => 'nullable|image|max:2048',
        ];

        $message = [
            'required' => 'Data wajib diisi!',
            'min' => 'Teks minimal :min karakter',
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
        $produk = Produk::findOrFail($id);
        $produk->nama = $request->nama;
        $produk->slug = Str::slug($request->nama);
        $produk->deskripsi = $request->deskripsi;
        if ($request->hasFile('cover')) {
            $produk->deleteCover();
            $image = $request->cover;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/produk/', $name);
            $produk->cover = $name;
        }
        $produk->save();
        session()->put('success', 'Data Berhasil diedit');
        return redirect()->route('produk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->deleteCover();
        $produk->delete();
        session()->put('success', 'Data Berhasil dihapus');
        return redirect()->route('produk.index');
    }
}