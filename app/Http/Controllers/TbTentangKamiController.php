<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tb_tentang_kami;
use Validator;

class TbTentangKamiController extends Controller
{
    public function index()
    {
        $tentangkami = Tb_tentang_kami::find(1);
        return view('admin.tentangkami.index', compact('tentangkami'));
    }

    public function tentangIndex()
    {
        $tentangkami = Tb_tentang_kami::find(1);
        return view('member.top-header.tentang-kami', compact('tentangkami'));
    }

    public function tentangkami(Request $request)
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
        $tentangkami = Tb_tentang_kami::findOrFail(1);
        $tentangkami->judul = $request->judul;
        $tentangkami->isi = $request->isi;
        $tentangkami->save();
        session()->put('success', 'Data Berhasil DiPublish');
        return redirect('master-admin/tentangkami');
    }
}