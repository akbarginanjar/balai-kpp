<?php

namespace App\Http\Controllers;

use App\Models\Tb_pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $penggunas = Tb_pengguna::where('id_user', Auth::user()->id)->get();
            foreach ($penggunas as $pengguna) {
                $pengguna;
            }
            if ($request->user()->id === 1 || $pengguna->isActive == 1) {
                session()->put('success', 'Anda telah berhasil login');
                return redirect('/master-admin/dashboard');
            } else {
                Auth::logout();
                toastr()->error(
                    'Akun Anda Di nonaktifkan Untuk Sementara',
                    'Gagal Login'
                );
                return redirect('/master-admin/login');
            }
        }
        toastr()->error('Akun Tidak Di Temukan', 'Gagal Login');
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/master-admin/login');
    }
}