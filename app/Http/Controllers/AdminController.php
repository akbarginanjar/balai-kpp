<?php

namespace App\Http\Controllers;

use App\Models\Tb_halaman;
use App\Models\Tb_artikel;
use App\Models\Tb_contact;
use App\Models\Tb_galeri;
use App\Models\Tb_kegiatan;
use App\Models\Tb_link;
use App\Models\Tb_menu;
use App\Models\Tb_slide;
use App\Models\Tb_submenu;
use App\Models\Tb_transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dataHalaman = Tb_halaman::count();
        $dataArtikel = Tb_artikel::count();
        $dataLink = Tb_link::count();
        $dataSlide = Tb_slide::count();
        $dataGaleri = Tb_galeri::count();
        $dataKontak = Tb_contact::count();
        $users = User::all();
        $usersFilter = $users->filter(function ($res) {
            return $res->id != 1;
        })->values();
        $dataUsers = $usersFilter->count();
        // $dataKegiatan = Tb_kegiatan::count();
        $menu = Tb_menu::count();
        $subMenu = Tb_submenu::count();
        return view('admin.index', compact('dataHalaman', 'dataArtikel', 'dataLink', 'dataSlide', 'dataGaleri', 'dataGaleri', 'dataKontak', 'dataUsers', 'menu', 'subMenu'));
    }

    public function module()
    {
        return view('admin.module');
    }

    public function login()
    {
        return view('admin.login');
    }
}
