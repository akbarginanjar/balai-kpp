<?php

namespace App\Http\Controllers;

use App\Models\Tb_konten;
use App\Models\Tb_link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $link = Tb_link::all();
        return view('admin.link.index', compact('link'));
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
            'nama' => 'required|unique:tb_links',
            'link' => 'required',
        ];

        $message = [
            'required' => 'Data harus di isi',
            'unique' => "Data Sudah Ada"
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $link = new Tb_link();
        $link->nama = $request->nama;
        $link->link = $request->link;
        $link->save();

        $konten = new Tb_konten();
        $konten->id_link = $link->id;
        $konten->type = "link";
        $konten->save();
        session()->put('success', 'Data Berhasil Di Tambahkan');
        return redirect()->route('link.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_link  $tb_link
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_link $tb_link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_link  $tb_link
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_link $tb_link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_link  $tb_link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nama' => 'required',
            'link' => 'required',
        ];

        $message = [
            'required' => 'Data harus di isi',
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $link = Tb_link::findOrFail($id);
        $link->nama = $request->nama;
        $link->link = $request->link;
        $link->save();
        session()->put('success', 'Data Berhasil Di Edit');
        return redirect()->route('link.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_link  $tb_link
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = Tb_link::findOrFail($id);
        if (!Tb_link::destroy($id)) {
            return redirect()->back();
        } else {
            $link->delete();
            session()->put('success', 'Data Berhasil Di Hapus');
            return redirect()->route('link.index');
        }
    }
}