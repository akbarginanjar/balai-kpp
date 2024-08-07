<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tb_karir;
use Validator;

class TbKarirController extends Controller
{
    public function index()
    {
        $karir = Tb_karir::find(1);
        return view('admin.karir.index', compact('karir'));
    }
    public function karirIndex()
    {
        $karir = Tb_karir::find(1);
        return view('member.top-header.karir', compact('karir'));
    }

    public function karir(Request $request)
    {
        $rules = [
            'judul' => 'required',
            'isi' => 'required',
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
        $karir = Tb_karir::findOrFail(1);
        $karir->judul = $request->judul;
        $karir->isi = $request->isi;
        $karir->save();
        session()->put('success', 'Data Berhasil DiPublish');
        return redirect('master-admin/karir');
    }
}