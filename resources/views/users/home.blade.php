@extends('layouts.main')

@section('title')
    {{$user->name}}
@endsection

@section('content')

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-8 text-center bg-secondary border border-5 border-dark text-white">
                <h2 class="my-4"><b>Your Posts</b></h2>
                <div class="my-4">
                    <a href="/posts/create" class="text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                        Create New Post
                    </a>
                </div>
                <div id="posts">
                    <div class="container d-flex mb-4">
                        <div class="col d-felx align-items-center justify-content-center">
                            <div class="col mx-auto">
                                @foreach ($user->posts as $post)
                                <div class="card mb-4 border border-dark border-5">
                                    <div class="row">
                                        <div class="col">
                                            <a class=card-body href="/post/{{$post->id}}">
                                                <h4 class=card-title>{{$post->title}}</h4>
                                                <p class=card-text>{{$post->content}}</p>
                                                <div>
                                                    <p>likes: {{$post->likedUsers->count()}}</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-grid justify-content-end">
                                                <div class="d-flex justify-content-center me-2">
                                                    <a class="btn btn-primary btn-lg mt-4 mb-2" href="{{route('posts.edit', ['id'=>$post->id])}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                        </svg>
                                                        Edit Post
                                                    </a>
                                                </div>
                                                <div class="d-flex me-2">
                                                    <form action="{{route('posts.delete', ['id'=>$post->id])}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-lg mt-2 mb-4" type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                              </svg>
                                                            Delete Post
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 text-center bg-secondary text-white border border-dark border-5">
                <h2>People You're Following</h2>

                @foreach ($user->following as $following)
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                @if ($user->image != null)
                                    <img src="{{image->id}}" alt="">
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