<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tb_faq;
use Validator;

class TbFaqController extends Controller
{
    public function index()
    {
        $faq = Tb_faq::find(1);
        return view('admin.faq.index', compact('faq'));
    }
    public function faqIndex()
    {
        $faq = Tb_faq::find(1);
        return view('member.top-header.faq', compact('faq'));
    }

    public function faq(Request $request)
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
        $faq = Tb_faq::findOrFail(1);
        $faq->pertanyaan = $request->pertanyaan;
        $faq->jawaban = $request->jawaban;
        $faq->save();
        session()->put('success', 'Data Berhasil DiPublish');
        return redirect('master-admin/faq');
    }
}