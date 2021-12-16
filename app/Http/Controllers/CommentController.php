<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function apiStore(Request $request)
    {
        //
        $validatedData = $request->validate([
            'content' => 'required',
            'user_id' => 'required|integer',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required'
        ]);

        if($request->commentable_type == "App\Models\Post") {
            $p = Post::findOrFail($request->commentable_id);
            $u = User::findOrFail($request->user_id);
            Mail::to($u->email)->send(new UserNotification($p, $u, $request->content));
        }

        $c = new Comment;
        $c->content = $validatedData['content'];
        $c->commentable_id = $validatedData['commentable_id'];
        $c->commentable_type = $validatedData['commentable_type'];
        $c->user_id = $validatedData['user_id'];
        $c->num_likes = 0;
        $c->date_of_creation = date('Y-m-d H-i-s');
        $c->save();

        return $c;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
