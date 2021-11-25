@extends('layouts.users')

@section('title')
    Register New User
@endsection

@section('content')
    
    <form method="POST" action="{{route('users.store')}}">
    
        @csrf
        <p>Name: <input type="text" name="name"></p>
        <p>Email: <input type="text" name="email"></p>
        <p>Confirm Email: <input type="text" name="confirm_email"></p>
        <p>Password: <input type="text" name="passwd"></p>
        <p>Confirm Password: <input type="text" name="confirm_passwd"></p>

        <input type="submit" value="Done">
        <a href="{{route('users.index')}}">Cancel</a>

    </form>

@endsection