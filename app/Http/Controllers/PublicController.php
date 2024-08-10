<?php

namespace App\Http\Controllers;

use App\Models\Tb_artikel;
use App\Models\Tb_galeri;
use App\Models\Tb_kategori_artikel;
use App\Models\Tb_kategori_galeri;
use App\Models\Tb_konten;
use App\Models\Tb_menu;
use App\Models\Tb_slide;
use App\Models\Tb_comment;
use App\Models\Tb_submenu;
use App\Models\Tb_video;
use App\Models\Produk;
use App\Models\Tb_visitor;
use App\Models\Tb_subscribe;
use App\Models\Tb_ebook;
use App\Models\Tb_kategori_ebook;
use App\Mail\MailComment;
use App\Models\KalenderKegiatan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PublicController extends Controller
{
    public function welcome(Request $request)
    {
        $accessToken = env('INSTAGRAM_ACCESS_TOKEN');
        $client = new \GuzzleHttp\Client();
    
        try {
            $response = $client->request('GET', 'https://graph.instagram.com/me/media', [
                'query' => [
                    'fields' => 'id,caption,media_type,media_url,thumbnail_url,permalink',
                    'access_token' => $accessToken,
                ]
            ]);
    
            $posts = json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            $posts = ['data' => []]; // Default to an empty array in case of an error
            // Optionally log the error: Log::error('Instagram API error: ' . $e->getMessage());
        }
    
        $slide = Tb_slide::all();
        
        // Store visitor details
        $visitor = Tb_visitor::create([
            'ip_address' => $request->ip(),
            'browser' => $request->header('User-Agent'),
            'device' => '-',
            'platform' => '-',
        ]);
        $visitor->save();
    
        $visitors = Tb_visitor::count();

        $year_all = KalenderKegiatan::orderBy('created_at', 'asc')->get()->pluck('waktu_kegiatan')
        ->map(function ($date) {
            return date('Y', strtotime($date));
        })->unique()->values();
     
        $check_scrol = false;

         if (isset($request->year)) {
            $kalender = KalenderKegiatan::whereYear('waktu_kegiatan', $request->year)->paginate(7);
            $collect = $kalender->isEmpty() ? [] : $kalender;
            $check_scrol = true;
        } else {
            $collect = KalenderKegiatan::orderBy('created_at', 'asc')->paginate(7);
            $check_scrol = false;
        }
        
        return view('welcome', compact('slide', 'visitors', 'collect', 'check_scrol','year_all'))->with('posts', $posts['data']);
        
    }
    
    

    public function menu(Tb_menu $tb_menu)
    {
        $menu = Tb_menu::find($tb_menu->id);
        $slide = Tb_slide::all();
        $kategoriGaleri = Tb_kategori_galeri::all();
        return view('member.menu', compact('menu', 'slide', 'kategoriGaleri'));
    }

    public function submenu(Tb_submenu $tb_submenu)
    {
        $submenu = Tb_submenu::find($tb_submenu->id);
        $slide = Tb_slide::all();
        $kategoriGaleri = Tb_kategori_galeri::all();
        $kalender = KalenderKegiatan::orderBy('created_at', 'asc')->get();

        
        return view(
            'member.submenu',
            compact('submenu', 'slide', 'kategoriGaleri','kalender')
        );
    }


    public function galeri(Tb_kategori_galeri $tb_kategori_galeri)
    {
        $kategoriGaleri = Tb_kategori_galeri::find($tb_kategori_galeri->id);
        $galeri = Tb_galeri::where(
            'id_kategori_galeri',
            $tb_kategori_galeri->id
        )->get();
        return view('member.galeri', compact('kategoriGaleri', 'galeri'));
    }

    public function artikel(Tb_kategori_artikel $tb_kategori_artikel)
    {
        $kategoriArtikel = Tb_kategori_artikel::find($tb_kategori_artikel->id);
        $artikel = Tb_artikel::where(
            'id_kategori_artikel',
            $tb_kategori_artikel->id
        )->paginate(9);
        return view('member.artikel', compact('kategoriArtikel', 'artikel'));
    }

    public function artikelDetail($tb_kategori_artikel, Tb_artikel $tb_artikel)
    {
        $artikel = Tb_artikel::find($tb_artikel->id);
        $url = url()->current();
        $artikel->increment('viewer');
        $artikels = Tb_artikel::inRandomOrder()
            ->paginate(5)
            ;
        $kategoriArtikel = Tb_kategori_artikel::all();
        $komentar = Tb_comment::where('id_artikel', $tb_artikel->id)->orderBy('created_at', 'desc')->get();
        return view(
            'member.artikel-detail',
            compact('artikel', 'artikels', 'kategoriArtikel', 'komentar', 'url')
        );
    }

    public function ebook(Tb_kategori_ebook $tb_kategori_ebook)
    {
        $kategoriEbook = Tb_kategori_ebook::find($tb_kategori_ebook->id);
        $ebook = Tb_ebook::where(
            'id_kategori_ebook',
            $tb_kategori_ebook->id
        )->paginate(9);
        return view('member.ebook', compact('kategoriEbook', 'ebook'));
    }

    public function ebookDetail($tb_kategori_ebook, Tb_ebook $tb_ebook)
    {
        $ebook = Tb_ebook::find($tb_ebook->id);
        $url = url()->current();
        $ebook->increment('viewer');
        $ebooks = Tb_ebook::inRandomOrder()
            ->paginate(5)
            ;
        $kategoriEbook = Tb_kategori_ebook::all();
        // $komentar = Tb_comment::where('id_artikel', $tb_artikel->id)->orderBy('created_at', 'desc')->get();
        return view(
            'member.ebook-detail',
            compact('ebook', 'ebooks', 'kategoriEbook', 'url')
        );
    }
    public function videoDetail(Tb_video $tb_video)
    {
        $video = Tb_video::find($tb_video->id);
        return view(
            'member.video-detail',
            compact('video')
        );
    }
    public function sendComment(Request $request)
    {
        // Tb_comment::create($request->except('_token'));

        $comment = new Tb_comment();
        $comment->id_artikel = $request->id_artikel;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->publish = 0;
        $comment->teks = $request->teks;
        $comment->save();

        $details = [
            'title' => 'Komentar dari ' . $request->email,
            'body' => 'Pesan : ' . $request->teks
        ];
        Mail::to('akbarginanjar0@gmail.com')->send(new MailComment($details));
        
        session()->put('success', 'Komentar Anda Berhasil Terkirim, akan diproses Admin');
        return back();
    }
    
    public function produkDetail(Produk $produk)
    {
        $produk = Produk::find($produk->id);
        $produks = Produk::inRandomOrder()
            ->limit(8)
            ->get();
        return view('member.produk-detail', compact('produk', 'produks'));
    }

    public function subscribe(Request $request)
    {
        Tb_subscribe::create($request->except('_token'));
        session()->put('success', 'Anda Berhasil Berlangganan');
        return back();
    }
}