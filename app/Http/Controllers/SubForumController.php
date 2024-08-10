<?php

namespace App\Http\Controllers;

use App\Models\SubForum;
use App\Models\Forum;
use Illuminate\Http\Request;
use App\Rules\NoProfanity;

class SubForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request)
    {
        $request->validate([
            'kepada' => ['required'],
            'nama' => ['required'],
            'email' => ['required','email'],
            'deskripsi' => ['required'],
            'id_forum' => ['required'],
        ]);
    
        // Create an instance of the NoProfanity rule
        $noProfanity = new NoProfanity();
    
        // Check for profanity in each field
        $fieldsWithProfanity = [];
        if (!$noProfanity->passes('email', $request->email)) {
            $fieldsWithProfanity[] = 'email';
        }
        if (!$noProfanity->passes('nama', $request->nama)) {
            $fieldsWithProfanity[] = 'nama';
        }
        if (!$noProfanity->passes('deskripsi', $request->deskripsi)) {
            $fieldsWithProfanity[] = 'deskripsi';
        }
    
        // If any fields contain profanity, show a warning and redirect back
        if (!empty($fieldsWithProfanity)) {
            return response()->json(['success' => false, 'message' => 'atribut berisi bahasa yang tidak pantas.'], 400);
        }      
    
        // Save the forum comment
        $forum = new SubForum();
        $forum->kepada = $request->kepada;
        $forum->name = $request->nama;
        $forum->email = $request->email;
        $forum->forum_id  = $request->id_forum;
        $forum->deskripsi = $request->deskripsi;
        $forum->save();
    
        // Success message
        return response()->json(['success' => true, 'message' => 'Comment successfully posted.']);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $forum = Forum::where('id', $id)->first();
        $subForum  = SubForum::where('forum_id', $forum->id)->get();
        return view('sub_forum', compact('forum','subForum'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index_master_admin($id)
    {
        $subforum = SubForum::where('forum_id',$id)->get();
        return view('admin.sub_forum.index', compact('subforum'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubForum  $subForum
     * @return \Illuminate\Http\Response
     */
    public function show(SubForum $subForum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubForum  $subForum
     * @return \Illuminate\Http\Response
     */
    public function edit(SubForum $subForum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubForum  $subForum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubForum $subForum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubForum  $subForum
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubForum $subForum, $id)
    {
        $subForum  = SubForum::find($id);
        $subForum->delete();
        toastr()->success('Sukses', 'Berhasil menghapus ');
        return redirect()->back();
    }
}
