<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function apiGetOne(int $id)
    {
        $u = User::findOrFail($id);
        return $u;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.create');
    }

    public function home()
    {
        if(Auth::check()) {
            return view('users.home', ['user' => Auth::user()]);
        } else {
            return route('login');
        }
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:rfc|unique:users,email_address',
            'confirm_email' => 'required|same:email',
            'password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()->symbols()]
        ]);
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
        $user = User::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        if(Auth::check()) {
            return view('users.edit', ['user' => Auth::user()]);
        } else {
            return route('login');
        }
    }

    public function authUpdatePassword(Request $request) 
    {
        $request->validate([
            'newPassword' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            'confirmPassword' => 'required|same:newPassword'
        ]);

        $id = Auth::User()->id;
        $u = User::findOrFail($id);
        $u->password = Hash::make($request->newPassword);
        $u->save();

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $id = Auth::User()->id;
        $u = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255'
        ]);

        $u->name = $request->name;
        $u->email = $request->email;

        $u->save();

        return back();
    }

    public function updateImage(Request $request)
    {
        $id = Auth::User()->id;
        $u = User::find($id);

        $request->validate([
            'image'=>'required|image|max:1999'
        ]);

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('images');
            $i = new Image;
            $i->image = $path;
            $u->image()->save($i);
            $u->save();
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
        $u = Auth::User();
        $user = User::findOrFail($u->id);
        $user->delete();
        return redirect('/logout')->with('message', 'account deleted');
    }
}
