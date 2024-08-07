<?php

namespace App\Http\Controllers;

use App\Models\Tb_kategori_ebook;
use App\Models\Tb_konten;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use DB;

class TbKategoriEbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoriEbook = Tb_kategori_ebook::all();
        return view('admin.kategori-ebook.index', compact('kategoriEbook'));
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
        $kategoriEbook = new Tb_kategori_ebook();
        $kategoriEbook->nama = $request->nama;
        $kategoriEbook->slug = Str::slug($request->nama);
        $kategoriEbook->save();

        $konten = new Tb_konten();
        $konten->id_kategori_ebook = $kategoriEbook->id;
        $konten->type = "kategori-ebook";
        $konten->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect()->route('kategori-ebook.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_kategori_ebook  $tb_kategori_ebook
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_kategori_ebook $tb_kategori_ebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_kategori_ebook  $tb_kategori_ebook
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_kategori_ebook  $tb_kategori_ebook
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
        $kategoriEbook = Tb_kategori_ebook::findOrFail($id);
        $kategoriEbook->nama = $request->nama;
        $kategoriEbook->slug = Str::slug($request->nama);
        $kategoriEbook->save();
        session()->put('success', 'Data Berhasil diedit');
        return redirect()->route('kategori-ebook.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_kategori_ebook  $tb_kategori_ebook
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $kategoriEbook = Tb_kategori_ebook::findOrFail($id);

                if ($kategoriEbook->hasDependentRecords()) {
                    throw new \Exception('Tidak dapat menghapus kategori ebook ini karena masih memiliki konten terkait.');
                }

                $kategoriEbook->delete();
            });

            return redirect()->route('kategori-ebook.index')->with('success', 'Kategori Ebook berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Tidak dapat menghapus kategori ebook ini karena masih memiliki konten terkait.');
        }
    }
}