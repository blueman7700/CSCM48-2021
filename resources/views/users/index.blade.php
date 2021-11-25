@extends('layouts.users')

@section('title')
    Users
@endsection

@section('content')
    
    <p>Registered users of CoreDump</p>
    <ul>
        @foreach ($users as $user)
            <li><a href="/{{$user->id}}/home">{{$user->name}}</a></li>
        @endforeach
    </ul>

    <a href="{{route('users.create')}}">Register New User</a>

@endsection