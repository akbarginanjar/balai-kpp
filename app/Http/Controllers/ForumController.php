<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Rules\NoProfanity;
use Illuminate\Http\Request;
use App\Models\SubForum;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public  function forum_index_member(){
        $forum = Forum::orderBy('created_at','asc')->get();
        $subForum = SubForum::orderBy('created_at','asc')->get();
        $check_forum_status =  Forum::orderBy('created_at','asc')->where('publish', 1)->count();
        return view('forum', compact('forum','check_forum_status','subForum'));
     }

     public function comment_post(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'subject' => ['required'],
            'email' => ['required', 'email'],
            'comment' => ['required'],
        ]);

        // Create an instance of the NoProfanity rule
        $noProfanity = new NoProfanity();

        // Check for profanity in each field
        $fieldsWithProfanity = [];
        if (!$noProfanity->passes('name', $request->name)) {
            $fieldsWithProfanity[] = 'name';
        }
        if (!$noProfanity->passes('subject', $request->subject)) {
            $fieldsWithProfanity[] = 'subject';
        }
        if (!$noProfanity->passes('comment', $request->comment)) {
            $fieldsWithProfanity[] = 'comment';
        }

        // If any fields contain profanity, show a warning and redirect back
        if (!empty($fieldsWithProfanity)) {
            toastr()->warning('Warning', 'atribut berisi bahasa yang tidak pantas.');
            return redirect()->back()->withInput();
        }
        if(strlen($request->subject) > 100){
            toastr()->warning('Warning', 'maksimal subject 100');
            return redirect()->back()->withInput();
        }

        
        // Save the forum comment
        $forum = new Forum();
        $forum->name = $request->name;
        $forum->subject = $request->subject;
        $forum->email = $request->email;
        $forum->publish = '1';
        $forum->comment = $request->comment;
        $forum->save();

        // Success message
        toastr()->success('Success', 'Comment successfully posted.');
        return redirect()->back();
    }

    
    public function index_master_admin()
    {
        $forum = Forum::orderBy('created_at','asc')->get();
        return view('admin.forum.index', compact('forum'));
    }
    public function publish($id){
        $forum = Forum::find($id);
        if($forum->publish == 0){
            $forum->publish = 1;
            $forum->save();
            toastr()->success('Success', 'berhasil di publish');
            return redirect()->back();
        }else if($forum->publish == 1){
            $forum->publish = 0;
            $forum->save();
            toastr()->success('Success', 'Berhasil Non Publish');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show(Forum $forum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function edit(Forum $forum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forum $forum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Temukan forum berdasarkan ID
        $forum = Forum::find($id);
        
        // Cek jika forum ditemukan
        if ($forum) {
            // Periksa apakah ada record anak di SubForum yang terkait dengan forum ini
            $subForums = SubForum::where('forum_id', $id)->get();
            
            if ($subForums->count() > 0) {
                // Hapus semua record anak terlebih dahulu
                foreach ($subForums as $subForum) {
                    $subForum->delete();
                }
            }
            
            // Hapus forum setelah record anak dihapus
            $forum->delete();
            toastr()->success('Sukses', 'Berhasil menghapus Forum');
        } else {
            toastr()->error('Gagal', 'Forum tidak ditemukan');
        }
        
        return redirect()->back();
    }
    
}
