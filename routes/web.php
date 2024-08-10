<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TbArtikelController;
use App\Http\Controllers\TbGaleriController;
use App\Http\Controllers\TbHalamanController;
use App\Http\Controllers\TbKategoriArtikelController;
use App\Http\Controllers\TbKategoriGaleriController;
use App\Http\Controllers\TbKategoriKegiatanController;
use App\Http\Controllers\TbKegiatanController;
use App\Http\Controllers\TbMenuController;
use App\Http\Controllers\TbPenggunaController;
use App\Http\Controllers\TbPetaController;
use App\Http\Controllers\TbSettingController;
use App\Http\Controllers\TbSlideController;
use App\Http\Controllers\TbSubmenuController;
use App\Http\Controllers\TbWilayahController;
use App\Http\Controllers\TbSdmController;
use App\Http\Controllers\TbSpmController;
use App\Http\Controllers\TbAnggaranController;
use App\Http\Controllers\TbContactController;
use App\Http\Controllers\TbJenisApdController;
use App\Http\Controllers\TbJenisKendaraanController;
use App\Http\Controllers\TbJenisPenyelamatanController;
use App\Http\Controllers\TbJenisRegulasiController;
use App\Http\Controllers\TbJenisRelawanController;
use App\Http\Controllers\TbJenisSopController;
use App\Http\Controllers\TbJenisTerbakarController;
use App\Http\Controllers\TbKdJenisRegulasiController;
use App\Http\Controllers\TbKdJenisSopController;
use App\Http\Controllers\TbKejadianKebakaranController;
use App\Http\Controllers\TbKejadianPenyelamatanController;
use App\Http\Controllers\TbKelembagaanController;
use App\Http\Controllers\TbKerjasamaDaerahController;
use App\Http\Controllers\TbKeuntunganController;
use App\Http\Controllers\TbLinkController;
use App\Http\Controllers\TbPertanyanController;
use App\Http\Controllers\TbRegulasiSopController;
use App\Http\Controllers\TbRelawanController;
use App\Http\Controllers\TbSarprasController;
use App\Http\Controllers\TbTahunAnggaranController;
use App\Http\Controllers\TbTahunController;
use App\Http\Controllers\TbTahunSpmController;
use App\Http\Controllers\TbTentangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TbKarirController;
use App\Http\Controllers\TbCommentController;
use App\Http\Controllers\TbFaqController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TbTentangKamiController;
use App\Http\Controllers\TbSubscribeController;
use App\Http\Controllers\TbVideoController;
use App\Http\Controllers\TbEbookController;
use App\Http\Controllers\TbKategoriEbookController;
use App\Http\Controllers\TbKategoriVideoController;
use App\Http\Controllers\KalenderKegiatanController;
use App\Http\Controllers\SubForumController;
use App\Http\Controllers\InstagramController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('/instagram/post', [InstagramController::class, 'post'])->name('instagram.post');

Route::get('/instagram', [InstagramController::class, 'index']);
Route::get('/instagram-create', [InstagramController::class, 'create']);


Route::get('forum', [ForumController::class, 'forum_index_member']);
Route::post('comment-post', [ForumController::class, 'comment_post']);


Route::get('/tentang-kami', [TbTentangKamiController::class, 'tentangIndex']);
// Route::get('/suku-bunga', function () {
//     return view('member.top-header.suku-bunga');
// });
Route::get('/artikel', function () {
    return view('member.top-header.artikel');
});
// Route::get('/informasi-lelang', [TbLelangController::class, 'lelangmember']);
// Route::get('/informasi-lelang/{id}', [
//     TbLelangController::class,
//     'detaillelang',
// ]);

// Route::get('/karir', [TbKarirController::class, 'karirIndex']);
// Route::get('/lokasi-kantor', function () {
//     return view('member.top-header.lokasi-kantor');
// });
Route::get('/faq', [TbFaqController::class, 'faqIndex']);

Route::get('/', [PublicController::class, 'welcome']);
Route::get('/m=>{tb_menu:slug}', [PublicController::class, 'menu']);
Route::get('/s=>{tb_submenu:slug}', [PublicController::class, 'submenu']);
Route::get('/galeri/{tb_kategori_galeri:slug}', [
    PublicController::class,
    'galeri',
]);
Route::get('/artikel/{tb_kategori_artikel:slug}', [
    PublicController::class,
    'artikel',
]);
Route::get('/artikel/{tb_kategori_artikel}/{tb_artikel:slug}', [
    PublicController::class,
    'artikelDetail',
]);
Route::get('/ebook/{tb_kategori_ebook:slug}', [
    PublicController::class,
    'ebook',
]);
Route::get('/ebook/{tb_kategori_ebook}/{tb_ebook:slug}', [
    PublicController::class,
    'ebookDetail',
]);
Route::get('/video/{tb_video:slug}', [
    PublicController::class,
    'videoDetail',
]);
Route::post('/subscribe', [
    PublicController::class,
    'subscribe',
]);
Route::post('/artikel/{tb_kategori_artikel}/{tb_artikel:slug}/sendComment', [
    PublicController::class,
    'sendComment',
]);
Route::get('/tentangkami/{tb_tentang_kami:slug}', [
    PublicController::class,
    'tentangkami',
]);
Route::get('/karir/{tb_karir:slug}', [PublicController::class, 'karir']);
Route::get('/faq/{tb_faq:slug}', [PublicController::class, 'faq']);
Route::get('/produk/{produk:slug}', [PublicController::class, 'produkDetail']);

Route::get('/contact', function () {
    return view('member.contact');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/master-admin/login', [LoginAdminController::class, 'index'])
    ->name('login')
    ->middleware('guest');
Route::post('/master-admin/login/proses', [
    LoginAdminController::class,
    'authenticate',
]);

Route::get('/api/calendar-events/{date}', [KalenderKegiatanController::class, 'getEventDetails']);


// routes/web.php
Route::post('/forum-reply', [SubForumController::class, 'reply'])->name('forum.reply');
Route::get('/forum/sub_forum/{id}', [SubForumController::class, 'index']);


Route::post('/s=>{tb_submenu:slug}', [App\Http\Controllers\PublicController::class, 'submenu'])->name('searchByYear');


Route::get('geoportal', [TbPetaController::class, 'geo']);
Route::get('/geoportal/{tb_petas:id}', [TbPetaController::class, 'detail']);
// Route Admin
Route::group(
    ['prefix' => 'master-admin', 'middleware' => ['auth', 'role:admin']],
    function () {

        Route::resource('kalender-kegiatan', KalenderKegiatanController::class);

        Route::get('/forum/sub-forum/{id}', [SubForumController::class,'index_master_admin']);
        Route::delete('/sub_forum/delete/{id}', [SubForumController::class,'destroy']);
        

        Route::get('forum', [ForumController::class,'index_master_admin']);
        Route::delete('forum/delete/{id}', [ForumController::class,'destroy']);
        Route::get('forum/publish/{id}',[ForumController::class, 'publish']);
        
        Route::get('logout', [LoginAdminController::class, 'logout']);
        Route::get('/', function () {
            return redirect('admin/dashboard');
        });
        Route::get('dashboard', [AdminController::class, 'index']);
        Route::get('module', [AdminController::class, 'module']);
        Route::resource('kategori-artikel', TbKategoriArtikelController::class);
        Route::resource('kategori-ebook', TbKategoriEbookController::class);
        Route::resource('kategori-video', TbKategoriVideoController::class);
        Route::resource('video', TbVideoController::class);
        Route::resource('kategori-galeri', TbKategoriGaleriController::class);
        Route::resource('artikel', TbArtikelController::class);
        Route::resource('ebook', TbEbookController::class);
        Route::resource('kontak', TbContactController::class);
        Route::resource('kelembagaan', TbKelembagaanController::class);
        Route::resource('kegiatan', TbKegiatanController::class);
        Route::resource('halaman', TbHalamanController::class);
        Route::resource('menu', TbMenuController::class);
        Route::resource('link', TbLinkController::class);
        Route::resource('tentang', TbTentangController::class);
        Route::resource('keuntungan', TbKeuntunganController::class);
        Route::resource('pertanyaan', TbPertanyanController::class);
        Route::resource('produk', ProdukController::class);
        Route::get('tentangkami', [TbTentangKamiController::class, 'index']);
        Route::get('karir', [TbKarirController::class, 'index']);
        Route::get('faq', [TbFaqController::class, 'index']);
        // Route::resource('submenu', TbSubmenuController::class);
        Route::get('comment/{id}', [
            TbCommentController::class,
            'index',
        ]);
        Route::post('comment/{id}/reply', [
            TbCommentController::class,
            'reply',
        ]);
        Route::post('comment/{id}/publish', [
            TbCommentController::class,
            'publish',
        ]);
        Route::post('comment/{id}/nonpublish', [
            TbCommentController::class,
            'nonPublish',
        ]);
        Route::delete('comment/{id}/delete', [
            TbCommentController::class,
            'destroy',
        ]);
        Route::get('menu/{tb_menu:slug}/submenu', [
            TbSubMenuController::class,
            'index',
        ]);
        Route::get('menu/{tb_menu:slug}/submenu/create', [
            TbSubMenuController::class,
            'create',
        ]);
        Route::post('menu/{tb_menu:slug}/submenu/store', [
            TbSubMenuController::class,
            'store',
        ]);
        Route::get('menu/{tb_menu:slug}/submenu/{id}/edit', [
            TbSubMenuController::class,
            'edit',
        ]);
        Route::post('menu/{tb_menu:slug}/submenu/{id}/update', [
            TbSubMenuController::class,
            'update',
        ]);
        Route::post('menu/{tb_menu:slug}/submenu/{id}/destroy', [
            TbSubMenuController::class,
            'destroy',
        ]);
        Route::resource('slide', TbSlideController::class);
        Route::resource('galeri', TbGaleriController::class);
        Route::resource('subscribe', TbSubscribeController::class);
        Route::resource('pengguna', TbPenggunaController::class);
        Route::get('pengguna_trash', [
            TbPenggunaController::class,
            'trash',
        ]);
        Route::get('pengguna/restore/{id}', [
            TbPenggunaController::class,
            'restore',
        ]);
        Route::get('pengguna/hapus_permanen/{id}', [
            TbPenggunaController::class,
            'hapus_permanen',
        ]);
        Route::get('pengguna/hapus_permanen_semua', [
            TbPenggunaController::class,
            'hapus_permanen_semua',
        ]);
        Route::resource('peta', TbPetaController::class);
        Route::post('urutan/{id}/atas', [TbMenuController::class, 'atas']);
        Route::post('urutan/{id}/bawah', [TbMenuController::class, 'bawah']);
        Route::post('menu/{tb_menu:slug}/submenu/urutan/{id}/atas', [
            TbSubMenuController::class,
            'atas',
        ]);
        Route::post('menu/{tb_menu:slug}/submenu/urutan/{id}/bawah', [
            TbSubMenuController::class,
            'bawah',
        ]);
        Route::get('setting', [TbSettingController::class, 'index']);
        Route::get('setting', [TbSettingController::class, 'index']);
        Route::post('setting/judul', [TbSettingController::class, 'judul']);
        Route::post('setting/lokasi', [TbSettingController::class, 'lokasi']);
        Route::post('setting/medsos', [TbSettingController::class, 'medsos']);
        Route::post('tentangkami/ubah', [
            TbTentangKamiController::class,
            'tentangkami',
        ]);
        Route::post('karir/ubah', [TbKarirController::class, 'karir']);
        Route::post('faq/ubah', [TbFaqController::class, 'faq']);
        Route::post('{id}/uaktif', [
            TbPenggunaController::class,
            'statusAktif',
        ]);
        Route::post('{id}/unonaktif', [
            TbPenggunaController::class,
            'statusNonaktif',
        ]);
        Route::post('upload', [TbArtikelController::class, 'upload'])->name(
            'upload'
        );
        Route::get('urutan', [TbMenuController::class, 'urutan']);
        Route::get('urutan/{id}', [TbMenuController::class, 'urutanedit']);
        Route::post('urutan/{id}/proses', [
            TbMenuController::class,
            'urutanproses',
        ]);
        Route::get('profile', [TbPenggunaController::class, 'profile']);
        Route::post('profile/{id}/edit', [
            TbPenggunaController::class,
            'profileEdit',
        ]);
        Route::get('akun', [TbPenggunaController::class, 'akun']);
        Route::post('akun/{id}/edit', [
            TbPenggunaController::class,
            'akunEdit',
        ]);
    }
);
Route::post('contact/store', [TbContactController::class, 'store'])->name(
    'contact.store'
);

Auth::routes([
    'register' => false,
    'login' => false,
]);