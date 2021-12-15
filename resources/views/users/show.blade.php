@extends('layouts.main')

@section('title')
    User Details
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-8 text-center bg-secondary border border-5 border-dark text-white">
            <h2 class="my-4"><b>{{$user->name}}'s Posts</b></h2>
            <div id="posts">
                <div class="container d-flex mb-4">
                    <div class="col d-felx align-items-center justify-content-center">
                        <div class="col mx-auto">
                            @foreach ($user->posts as $post)
                            <div class="card mb-4 border border-dark border-5">
                                <a class=card-body href="/post/{{$post->id}}">
                                    <h4 class=card-title>{{$post->title}}</h4>
                                    <p class=card-text>{{$post->content}}</p>
                                    <div>
                                        <p>likes: {{$post->likedUsers->count()}}</p>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 text-center bg-secondary text-white border border-dark border-5">
            <h2>{{$user->name}}'s followers</h2>

            @foreach ($user->followers as $following)
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            @if ($user->image != null)
                                <img src="{{asset('storage/'.$user->image->image)}}" alt="">
                            @else
                                <img src="{{asset("/default.png")}}" alt="" width="100" height="100" class="border border-dark rounded-circle">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <a class="card-body" href="/users/{{$following->id}}">
                                <h4 class="card-title text-black"><b>{{$following->name}}</b></h3>
                            </a>
                        </div>
                    </div>
                    
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
