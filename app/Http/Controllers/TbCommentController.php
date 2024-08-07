<?php

namespace App\Http\Controllers;

use App\Models\Tb_comment;
use Illuminate\Http\Request;

class TbCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    

    public function index($id)
    {
        $comment = Tb_comment::where('id_artikel', $id)->orderBy('created_at', 'desc')->get();
        return view('admin.comment.index', compact('comment'));
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
     * @param  \App\Models\Tb_comment  $tb_comment
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_comment $tb_comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_comment  $tb_comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_comment $tb_comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_comment  $tb_comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_comment $tb_comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_comment  $tb_comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Tb_comment::findOrFail($id);
        $comment->delete();
        session()->put('success', 'Data Berhasil dihapus');
        return redirect()->back();
    }

    public function reply(Request $request, $id)
    {
        $comment = Tb_comment::findOrFail($id);
        $comment->reply = $request->reply;
        $comment->save();
        session()->put('success', 'Komentar berhasil direply');
        return redirect()->back();
    }
    public function publish($id)
    {
        $comment = Tb_comment::findOrFail($id);
        $comment->publish = 1;
        $comment->save();
        session()->put('success', 'Data Berhasil Di Publish');
        return redirect()->back();
    }
    public function nonPublish($id)
    {
        $comment = Tb_comment::findOrFail($id);
        $comment->publish = 0;
        $comment->save();
        session()->put('success', 'Data Berhasil Di Tidak Publishkan');
        return redirect()->back();
    }
}