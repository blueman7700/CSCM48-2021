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
        <div class="container d-flex">
            <div class="col d-felx align-items-center justify-content-center">
                <div class="col-sm-6 mx-auto" v-for="post in posts">
                    <div class=card>
                        <div class=card-body>
                            <h4 class=card-title>@{{post.title}}</h4>
                            <p class=card-text>@{{post.content}}</p>
                            <div class=col-sm-8>
                                <p>likes: @{{post.num_likes}}</p>
                                <p>comments: @{{n_comments}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container d-flex">
            <ul>
                <li v-for="p_comment in comments">
                    @{{p_comment.id}}
                    <ul>
                        <li v-for="comment in p_comment.data">
                            @{{comment.content}}
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

<script>
    var app = new Vue({
        el: "#posts",
        data: {
            promises: [],
            posts: [],
            comments: [],
            n_comments: 0,
        },
        mounted() {
            axios.get("{{route('api.posts.index.from', ['id' => Auth::User()->id])}}")
                .then(response=>{
                    this.posts = response.data;
                    const tmp = response.data;
                    this.promises = tmp.map(post => {
                        axios.get("/api/posts/" + post.id + "/comments/")
                            .then(response=>{
                                const c = {id: post.id, data: response.data};
                                this.comments.push(c);})
                            .catch(response=>{
                                console.log(response);
                        })
                    })
                })
                .catch(response=>{
                    console.log(response);
            });
            Promise.all(this.promises).then(data=>{
                console.log(this.comments);
            });
        }
    });
</script>

@endsection