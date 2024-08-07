<?php

namespace App\Http\Controllers;

use App\Models\TbLelang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class TbLelangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $lelang = TbLelang::all();
       return view('admin.lelang.index', compact('lelang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lelang.create');
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
            'harga' => 'required',
            'deskripsi' => 'required',
            'alamat' => 'required',
            'gambar' => 'required',
        ];

        $message = [
            'nama.required' => 'nama harus di isi',
            'harga.required' => 'harga harus di isi',
            'deskripsi.required' => 'deskripsi harus di isi',
            'alamat.required' => 'alamat harus di isi',
            'gambar.required' => 'gambar harus di isi',
        ];
        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }

        $lelang = new TbLelang();
        $lelang->nama = $request->nama;
        $lelang->harga = $request->harga;
        $lelang->deskripsi = $request->deskripsi;
        $lelang->alamat = $request->alamat;
        if ($request->hasFile('gambar')) {
            $image = $request->gambar;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/lelang/', $name);
            $lelang->gambar = $name;
        }
        $lelang->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect()->route('lelang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TbLelang  $tbLelang
     * @return \Illuminate\Http\Response
     */
    public function show(TbLelang $tbLelang, $id)
    {
        $lelang = TbLelang::findOrFail($id);
        return view('admin.lelang.show', compact('lelang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TbLelang  $tbLelang
     * @return \Illuminate\Http\Response
     */
    public function edit(TbLelang $tbLelang,$id)
    {
        $lelang = TbLelang::findOrFail($id);
        return view('admin.lelang.edit', compact('lelang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TbLelang  $tbLelang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TbLelang $tbLelang ,$id)
    {
        $lelang = TbLelang::findOrFail($id);
        $lelang->nama = $request->nama;
        $lelang->harga = $request->harga;
        $lelang->deskripsi = $request->deskripsi;
        $lelang->alamat = $request->alamat;
        if ($request->hasFile('gambar')) {
            $image = $request->gambar;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/lelang/', $name);
            $lelang->gambar = $name;
        }
        $lelang->save();
        session()->put('success', 'Data Berhasil Di Ubah');
        return redirect('/admin/lelang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TbLelang  $tbLelang
     * @return \Illuminate\Http\Response
     */
    public function destroy(TbLelang $tbLelang, $id)
    {
        $lelang = TbLelang::findOrFail($id);
        if (!TbLelang::destroy($id)) {
            return redirect()->back();
        } else {
            $lelang->delete();
            session()->put('success', 'Data Berhasil Di Hapus');
            return redirect()->route('lelang.index');
        }
    }

   public function lelangmember(){
    $lelang = TbLelang::all();
    return view('member.top-header.informasi-lelang', compact('lelang'));
   }
   public function detaillelang($id){
    $lelang = TbLelang::findOrFail($id);
    return view('member.top-header.informasi-lelang-detail', compact('lelang'));
   }
}
