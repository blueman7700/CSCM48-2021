<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('posts.index');
    }

    public function apiIndex() 
    {
        $posts = Post::orderBy('date_of_creation', 'desc')->get();
        return $posts;
    }

    public function apiIndexFrom($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts;
        return $posts;
    }

    public function apiGetOne(int $id)
    {
        $post = Post::findOrFail($id);
        return $post;
    }

    public function apiGetCommentsFor(int $id)
    {
        $post = Post::findOrFail($id);
        return $post->comments;
    }

    public function apiIncLikes(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'user_id'=>'required'
        ]);

        $p = Post::findOrFail($request->id);
        $u = User::findOrFail($request->user_id);

        $p->likedUsers()->attach($u->id);
    }

    public function apiDecLikes(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'user_id'=>'required'
        ]);

        $p = Post::findOrFail($request->id);
        $u = User::findOrFail($request->user_id);

        $p->likedUsers()->wherePivot('user_id', $u->id)->detach();
    }

    public function apiGetLikes(int $id)
    {
        $p = Post::findOrFail($id);
        return $p->likedUsers->count();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
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
        $request->validate([
            'title'=>'required',
            'content'=>'required',
            'user_id'=>'required',
            'image'=>'image|nullable|max:1999'
        ]);

        $u = User::findOrFail($request->user_id);
        $p = new Post;
        $p->title = $request->title;
        $p->content = $request->content;
        $p->user_id = $u->id;
        $p->date_of_creation = now();
        $p->save();

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('images');
            $i = new Image;
            $i->image = $path;
            $p->image()->save($i);
            $p->save();
        }

        return redirect()->route('users.home');
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
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
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
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post'=>$post]);
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
        $request->validate([
            'title'=>'required',
            'content'=>'required',
            'image'=>'image|nullable|max:1999'
        ]);

        $p = Post::findOrFail($id);
        $p->title = $request->title;
        $p->content = $request->content;

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('images');
            $i = new Image;
            $i->image = $path;
            $p->image()->save($i);
        }

        $p->save();
        return redirect()->route('users.home');
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
        $p = Post::findOrFail($id);
        $p->delete();
        return back();
    }
}
