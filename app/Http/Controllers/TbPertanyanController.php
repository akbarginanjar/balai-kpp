<?php

namespace App\Http\Controllers;

use App\Models\Tb_pertanyan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbPertanyanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pertanyaan = Tb_pertanyan::all();
        return view('admin.pertanyaan.index', compact('pertanyaan'));
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
     * @param  \App\Models\Tb_pertanyan  $tb_pertanyan
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_pertanyan $tb_pertanyan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_pertanyan  $tb_pertanyan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_pertanyan $tb_pertanyan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_pertanyan  $tb_pertanyan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'pertanyaan' => 'required',
            'jawaban' => 'required',
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
        $pertanyan = Tb_pertanyan::findOrFail($id);
        $pertanyan->pertanyaan = $request->pertanyaan;
        $pertanyan->jawaban = $request->jawaban;
        $pertanyan->save();
        session()->put('success', 'Data Berhasil Di Simpan');
        return redirect('master-admin/pertanyaan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_pertanyan  $tb_pertanyan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_pertanyan $tb_pertanyan)
    {
        //
    }
}