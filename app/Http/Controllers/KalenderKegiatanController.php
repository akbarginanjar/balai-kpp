<?php

namespace App\Http\Controllers;

use App\Models\KalenderKegiatan;
use Illuminate\Http\Request;

class KalenderKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kegiatan = KalenderKegiatan::orderBy('created_at','asc')->get();
        return view('admin.kalender_kegiatan.index', compact('kegiatan'));
    }

    public function getEventDetails($date)
    {
        $events = KalenderKegiatan::whereDate('waktu_kegiatan', $date)->get();
    
        if ($events->isNotEmpty()) {
            $eventDetails = $events->map(function ($event) {
                // Bold hanya nama kegiatan, tanpa formatting lain pada deskripsi
                $status = $event->status == 1 ? 
                    '<button disabled class="btn btn-success">Terlaksana</button>' : 
                    '<button disabled class="btn btn-secondary">Belum Terlaksana</button>';
    
                return '<b>Nama Kegiatan: ' . htmlspecialchars($event->nama_kegiatan) . '</b><br>' . 
                       'Deskripsi Kegiatan: ' . (htmlspecialchars($event->deskripsi) ?? 'No description available.') . 
                       '<br><br>' . $status . 
                       '<hr>';
            })->join(''); // Menggabungkan hasil dengan <hr> sebagai pemisah
    
            return response()->json([
                'content' => $eventDetails
            ]);
        } else {
            return response()->json([
                'content' => 'No event found for this date.'
            ]);
        }
    }
    
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kalender_kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kegiatan = new KalenderKegiatan();
        $kegiatan->nama_kegiatan = $request->nama_kegiatan;
        $kegiatan->deskripsi = $request->deskripsi;
        $kegiatan->waktu_kegiatan = $request->waktu_kegiatan;
        $kegiatan->status = '0';
        $kegiatan->save();
        toastr()->success('Success', 'Berhasil Menambah Kegiatan');
        return redirect('master-admin/kalender-kegiatan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KalenderKegiatan  $kalenderKegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(KalenderKegiatan $kalenderKegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KalenderKegiatan  $kalenderKegiatan
     * @return \Illuminate\Http\Response
     */
    public function edit(KalenderKegiatan $kalenderKegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KalenderKegiatan  $kalenderKegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KalenderKegiatan $kalenderKegiatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KalenderKegiatan  $kalenderKegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KalenderKegiatan $kalenderKegiatan)
    {
        //
    }
}
