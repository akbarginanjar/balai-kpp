<?php

namespace App\Http\Controllers;

use App\Models\Tb_subscribe;
use Illuminate\Http\Request;

class TbSubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribe = Tb_subscribe::orderBy('created_at', 'desc')->get();
        return view('admin.subscribe.index', compact('subscribe'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_subscribe  $tb_subscribe
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_subscribe $tb_subscribe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_subscribe  $tb_subscribe
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_subscribe $tb_subscribe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_subscribe  $tb_subscribe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_subscribe $tb_subscribe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_subscribe  $tb_subscribe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_subscribe $tb_subscribe)
    {
        //
    }
}