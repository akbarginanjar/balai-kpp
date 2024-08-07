<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Tb_pengguna;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TbPenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengguna = Tb_pengguna::all();
        return view('admin.user.pengguna.index', compact('pengguna'));
    }

    public function trash()
    {
        $pengguna = Tb_pengguna::onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->get();
        return view('admin.user.pengguna.trash', ['pengguna' => $pengguna]);
    }

    public function restore($id)
    {
        $pengguna = Tb_pengguna::onlyTrashed()->where('id', $id);
        $pengguna->restore();
        session()->put('success', 'Data Berhasil Di Kembalikan');
        return redirect('/master-admin/pengguna');
    }

    // hapus permanen
    public function hapus_permanen($id)
    {
        // hapus permanen data guru
        $pengguna = tb_pengguna::onlyTrashed()->where('id', $id);
        $pengguna->forceDelete();
        session()->put('success', 'Data Berhasil Dihapus');
        return redirect('/master-admin/pengguna_trash');
    }

    // hapus permanen semua guru yang sudah dihapus
    public function hapus_permanen_semua()
    {
        // hapus permanen semua data guru yang sudah dihapus
        $pengguna = Tb_pengguna::onlyTrashed();
        $pengguna->forceDelete();
        session()->put('success', 'Semua Data Berhasil Dihapus');
        return redirect('/master-admin/pengguna_trash');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.pengguna.create');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'min:6',
            'password_confirmation' => 'min:6|required_with:password|same:password',
        ];

        $message = [
            'required' => 'Data tidak boleh kosong',
            'unique' => 'User Sudah ada!',
            'email' => 'Email maksimal :max karakter',
            'min' => 'Password minimam :min karakter',
            'same' => 'Konfirmasi Password tidak sama dengan Password',
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $adminRole = Role::where('name', 'admin')->first();
        $user->attachRole($adminRole);
        $pengguna = new Tb_pengguna();
        $pengguna->id_user = $user->id;
        $pengguna->jenis_kelamin = "-";
        $pengguna->agama = "-";
        $pengguna->no_telepon = "-";
        $pengguna->isActive = 1;
        $pengguna->save();
        session()->put('success', 'Data Berhasil Di Tambahkan');
        return redirect()->route('pengguna.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Tb_pengguna::findOrFail($id);
        return view('admin.user.pengguna.show', compact('user'));
    }

    public function statusAktif($id)
    {
        $pengguna = Tb_pengguna::findOrFail($id);
        $pengguna->isActive = 1;
        $pengguna->save();
        session()->put('success', 'Data Berhasil Di Aktifkan');
        return redirect()->back();
    }
    public function statusNonaktif($id)
    {
        $pengguna = Tb_pengguna::findOrFail($id);
        $pengguna->isActive = 0;
        $pengguna->save();
        session()->put('success', 'Data Berhasil Di Non Aktifkan');
        return redirect()->back();
    }

    public function edit($id)
    {
        $user = Tb_pengguna::findOrFail($id);
        return view('admin.user.pengguna.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'min:6',
            'password_confirmation' => 'min:6|required_with:password|same:password',
        ];

        $message = [
            'required' => 'Data tidak boleh kosong',
            'unique' => 'User Sudah ada!',
            'email' => 'Email maksimal :max karakter',
            'min' => 'Password minimam :min karakter',
            'same' => 'Konfirmasi Password tidak sama dengan Password',
        ];
        $pengguna = Tb_pengguna::findOrFail($id);
        $pengguna->no_telepon = "-";
        $pengguna->save();
        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $user = User::find($pengguna->user->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        session()->put('success', 'Data Berhasil Di Edit');
        return redirect()->route('pengguna.index');
    }

    public function destroy($id)
    {
        $pengguna = Tb_pengguna::findOrFail($id);
        if (!Tb_pengguna::destroy($id)) {
            return redirect()->back();
        } else {
            $pengguna->delete();
            session()->put('success', 'Data Berhasil Di Hapus');
            return redirect()->back();
        }
    }

    public function profile()
    {
        $penggunas = Tb_pengguna::where('id_user', Auth::user()->id)->get();
        foreach ($penggunas as $pengguna) {
            $pengguna;
        }
        return view('admin.user.profile', compact('pengguna'));
    }

    public function profileEdit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'no_telepon' => 'required',
        ]);
        $pengguna = Tb_pengguna::find($id);
        $pengguna->tgl_lahir = $request->tgl_lahir;
        $pengguna->jenis_kelamin = $request->jenis_kelamin;
        $pengguna->agama = $request->agama;
        $pengguna->no_telepon = $request->no_telepon;
        $pengguna->save();

        $user = User::findOrFail($pengguna->user->id);
        $user->name = $request->name;
        $user->save();
        session()->put('success', 'Data Berhasil Di Edit');
        return redirect()->back();
    }

    public function akunEdit(Request $request, $id)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8']
        ]);

        $user = User::findOrFail($id);
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        session()->put('success', 'Data Berhasil Di Edit');
        return redirect()->back();
    }

    public function akun()
    {
        $penggunas = Tb_pengguna::where('id_user', Auth::user()->id)->get();
        foreach ($penggunas as $pengguna) {
            $pengguna;
        }
        return view('admin.user.akun', compact('pengguna'));
    }
}