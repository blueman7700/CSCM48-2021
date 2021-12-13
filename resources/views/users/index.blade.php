@extends('layouts.main')

@section('title')
    Users
@endsection

@section('content')

    <p>Registered users of CoreDump</p>
    <ul>
        @foreach ($users as $user)
            <li><a href="/users/{{$user->id}}">{{$user->name}}</a></li>
        @endforeach
    </ul>

@endsection
