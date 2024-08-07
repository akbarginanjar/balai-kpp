<?php

namespace App\Http\Controllers;

use App\Models\Tb_slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TbSlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slide = Tb_slide::all();
        return view('admin.slide.index', compact('slide'));
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
            'gambar' => 'required|image|max:2048',
            'deskripsi' => 'required'
        ];

        $message = [
            'required' => 'Data wajib diisi!',
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $slide = new Tb_slide();
        $slide->deskripsi = $request->deskripsi;
        if ($request->hasFile('gambar')) {
            $image = $request->gambar;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/slide/', $name);
            $slide->gambar = $name;
        }
        $slide->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect()->route('slide.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_slide  $tb_slide
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_slide $tb_slide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_slide  $tb_slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_slide $tb_slide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_slide  $tb_slide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'gambar' => 'image|max:2048',
            'deskripsi' => 'required'
        ];

        $message = [
            'required' => 'Data wajib diisi!',
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $slide = Tb_slide::findOrFail($id);
        $slide->deskripsi = $request->deskripsi;
        if ($request->hasFile('gambar')) {
            $slide->deleteGambar();
            $image = $request->gambar;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/slide/', $name);
            $slide->gambar = $name;
        }
        $slide->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect()->route('slide.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_slide  $tb_slide
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Tb_slide::findOrFail($id);
        $slide->deleteGambar();
        $slide->delete();
        session()->put('success', 'Data Berhasil dihapus');
        return redirect()->route('slide.index');
    }
}