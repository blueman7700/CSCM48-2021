@extends('layouts.main')

@section('title')
    {{$user->name}}
@endsection

@section('content')

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

    <ul>
        <li>Name: {{$user->name}}</li>
        <li>ID: {{$user->id}}</li>
        <li>Email: {{$user->email}}</li>
        <li>Posts: {{$user->Posts->count()}}</li>
        <li>Followers: {{$user->Followers->count()}}</li>
        <li>Following: {{$user->Following->count()}}</li>
    </ul>
    <h3>Followers</h3>
    <ul>
        @foreach ($user->Followers as $follower)
            <li><a href="/{{$follower->id}}/home">{{$follower->name}}</a></li>
        @endforeach
    </ul>
    <h3>Following</h3>
    <ul>
        @foreach ($user->Following as $user)
            <li><a href="/{{$user->id}}/home">{{$user->name}}</a></li>
        @endforeach
    </ul>
    <div class="container d-flex align-items-center justify-content-center">
        <a href="/logout" role="button">
            Logout
        </a>
    </div>

    <div id="root">
        <ul>
            <li v-for="post in posts">@{{ post.title }}</li>
        </ul>
    </div>

<script>
    var app = new Vue({
        el: "#root",
        data: {
            posts: [],
        },
        mounted(){
            axios.get("{{route('api.posts.index.from', ['id' => Auth::User()->id])}}")
                .then(response=>{
                    this.posts = response.data;
                })
                .catch(response=>{
                    console.log(response);
            })
        }
    });
</script>

@endsection