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
            <li><a href="/home/{{$follower->id}}">{{$follower->name}}</a></li>
        @endforeach
    </ul>
    <h3>Following</h3>
    <ul>
        @foreach ($user->Following as $following)
            <li><a href="/home/{{$following->id}}">{{$following->name}}</a></li>
        @endforeach
    </ul>
    <div class="container d-flex align-items-center justify-content-center">
        <a href="/logout" role="button">
            Logout
        </a>
    </div>

    <div id="posts">
        <div class="container d-flex mb-4">
            <div class="col d-felx align-items-center justify-content-center">
                <div class="col-sm-6 mx-auto" v-for="post in posts">
                    <div class=card>
                        <a class=card-body :href="'/post/' + post.id">
                            <h4 class=card-title>@{{post.title}}</h4>
                            <p class=card-text>@{{post.content}}</p>
                            <div class="col-sm-8 me-4" >
                                <p>likes: @{{post.num_likes}}</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    var app = new Vue({
        el: "#posts",
        data: {
            posts: []
        },
        mounted() {
            axios.get("{{route('api.posts.index.from', ['id' => Auth::User()->id])}}")
                .then(response=>{
                    this.posts = response.data;
                })
                .catch(response=>{
                    console.log(response);
            });
        }
    });
</script>

@endsection