<?php

namespace App\Http\Controllers;

use App\Models\Tb_setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Tb_setting::find(1);
        return view('admin.setting.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function judul(Request $request)
    {
        $rules = [
            'gambar' => 'image|max:2048',
            'judul' => 'required',
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
        $setting = Tb_setting::findOrFail(1);
        $setting->judul = $request->judul;
        if ($request->hasFile('icon')) {
            $setting->deleteicon();
            $image = $request->icon;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/ikon/', $name);
            $setting->icon = $name;
        }
        $setting->save();
        session()->put('success', 'Data Berhasil DiPublish');
        return redirect('master-admin/setting');
    }

    public function lokasi(Request $request)
    {
        $rules = [
            'alamat' => 'required',
            'call_us' => 'required',
            'email_us' => 'required',
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
        $setting = Tb_setting::findOrFail(1);
        $setting->alamat = $request->alamat;
        $setting->call_us = $request->call_us;
        $setting->email_us = $request->email_us;
        $setting->save();
        session()->put('success', 'Data Berhasil DiPublish');
        return redirect('master-admin/setting');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function medsos(Request $request)
    {
        $rules = [
            'facebook' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            // 'linkedin' => 'required',
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
        $setting = Tb_setting::findOrFail(1);
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->instagram = $request->instagram;
        // $setting->linkedin = $request->linkedin;
        $setting->save();
        session()->put('success', 'Data Berhasil DiPublish');
        return redirect('master-admin/setting');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_setting  $tb_setting
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_setting $tb_setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_setting  $tb_setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_setting $tb_setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_setting  $tb_setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_setting $tb_setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_setting  $tb_setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_setting $tb_setting)
    {
        //
    }
}