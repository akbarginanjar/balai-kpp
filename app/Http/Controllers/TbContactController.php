<?php

namespace App\Http\Controllers;

use App\Models\Tb_contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = Tb_contact::orderBy('created_at', 'desc')->get();
        return view('admin.contact.index', compact('contact'));
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
            'email' => 'required',
            'pesan' => 'required',
            // 'g-recaptcha-response' => 'required|captcha'
        ];

        $message = [
            'nama.required' => 'Nama Lengkap harus di isi',
            'email.required' => 'Email harus di isi',
            'pesan.required' => 'Pesan harus di isi',
            // 'g-recaptcha-response' => [
            //     'required' => 'Please verify that you are not a robot.',
            //     'captcha' => 'Captcha error! try again later or contact site admin.',
            // ],
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }

        $contact = new Tb_contact();
        $contact->nama = $request->nama;
        $contact->email = $request->email;
        $contact->pesan = $request->pesan;
        $contact->save();

        session()->put('success', 'Pesan Anda Berhasil Terkirim');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_contact  $tb_contact
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_contact $tb_contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_contact  $tb_contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_contact $tb_contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_contact  $tb_contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_contact $tb_contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_contact  $tb_contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Tb_contact::findOrFail($id);
        if (!Tb_contact::destroy($id)) {
            return redirect()->back();
        } else {
            $contact->delete();
            session()->put('success', 'Data Berhasil Di Hapus');
            return redirect()->route('kontak.index');
        }
    }
}