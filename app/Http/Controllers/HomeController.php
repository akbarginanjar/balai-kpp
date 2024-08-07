<?php

namespace App\Http\Controllers;

use App\Models\Tb_penyewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->hasRole('member')) {
            $penyewas = Tb_penyewa::where('id_user', Auth::user()->id)->get();
            foreach ($penyewas as $penyewa) {
                $penyewa;
            }
            if ($penyewa->isActive == 0) {
                Auth::logout();
                toastr()->error(
                    'Maaf Akun Anda Di Non Aktifkan Sementara',
                    'Gagal Login'
                );
                return redirect('/login');
            } else {
                toastr()->success(
                    'Selamat Anda Berhasil Login!',
                    'Behasil Login'
                );
                return redirect('member');
            }
        }

        if ($request->user()->hasRole('admin')) {
            Auth::logout();
            toastr()->error('Anda Adalah Admin', 'Maaf');
            return redirect('/master-admin/login');
        }
    }
}