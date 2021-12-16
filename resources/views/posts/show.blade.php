@extends('layouts.main')

@section('title')
    Post Details
@endsection

@section('content')

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

<style>
    div#social-links {
        margin: 0 auto;
        max-width: 500px;
    }
    div#social-links ul li {
        display: inline-block;
    }          
    div#social-links ul li a {
        padding: 20px;
        border: 1px solid #ccc;
        margin: 1px;
        font-size: 30px;
        color: #222;
        background-color: #ccc;
    }
</style>


    <div>
        <h1 class="ms-4">{{$post->title}}</h2>
    </div>
    <div>
        <p class="ms-4">posted by: <a href="/users/{{$post->user->id}}">{{$post->user->name}}</a> on {{$post->created_at}}</p>
    </div>
    
    <div class="container-fluid d-flex ms-2">
        @if ($post->image != null)
            <img width="250" height="auto" src="{{asset('storage/'.$post->image->image)}}" alt="">
        @endif
        <p class="ms-4">{{$post->content}}</p>
    </div>
    <div id="likes">
        <input type="text" class="form-control-plaintext ms-4 mb-4" v-model="likesText" value="Likes: {{$post->likedUsers->count()}}">
        @if ($post->likedUsers->find(Auth::User()->id) != null)
            <button class="btn btn-success mb-4 ms-4" @click="decLikes">
                <h4>Liked!</h4>
            </button>
        @else
            <button class="btn btn-primary mb-4 ms-4" @click="incLikes">
                <h4>Like</h4>
            </button>
        @endif
    </div>

    <div class="container-fluid">
        <h3 class="mb-5 text-center">Share This Post</h3>
        {!! $shareComponent !!}
    </div>

    <div id="comments" class="mx-4">
        <h3>Comments:</h4>
        <div class="container-fluid row text-center justify-content-center">
            <textarea type="text" id="commentContent" v-model="newCommentContent" class="form-control col-sm-6"></textarea>
            <button class="btn btn-primary col-sm-1" @click="createComment">add</button>
        </div>
        <div class="container-fluid">
           <div class="col">
                <div class="card" v-for="comment in comments">
                    <div class="card-body">
                        <a :href="'/users/' + comment.user_id" ><h4 class="card-title">@{{comment.user}}</h4></a>
                        <p class="card-text">@{{comment.text}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        var app = new Vue({
            el: "#comments",
            data: {
                comments: [],
                promises: [],
                newCommentContent: '',
                commentableID: '{{$post->id}}',
                commentableType: 'App\\Models\\Post',
                userID: '{{Auth::User()->id}}',
                userName: '{{Auth::User()->name}}'
            },
            mounted() {
                axios.get("{{route('api.posts.comments', ['id' => $post->id])}}").then(response => {
                    const tmp_comments = response.data;
                    this.promises = tmp_comments.map(comment=> {
                        axios.get("/api/users/" + comment.user_id).then(response=> {
                            const c = {user_id: response.data.id, user: response.data.name, text: comment.content};
                            this.comments.push(c);
                        }).catch(response=> {
                            console.log(response);
                        })
                    })
                }).catch(response => {
                    console.log(response)
                });
                Promise.all(this.promises).then(data=> {
                    console.log(this.comments)
                });
            },
            methods: {
                createComment:function() {
                    axios.post("{{route('api.comments.store')}}", {
                        content: this.newCommentContent, 
                        commentable_id: this.commentableID,
                        commentable_type: this.commentableType,
                        user_id: this.userID
                    }).then(response=>{
                        const c = {user_id: this.userID, user: this.userName, text: this.newCommentContent};
                        this.comments.push(c);
                        this.newCommentContent = '';
                    }).catch(response=>{
                        console.log(response)
                    })
                }
            }
        });

        var app2 = new Vue({
            el: "#likes",
            data: {
                likesText: "",
                promises: [],
                p_id: '{{$post->id}}',
                u_id: '{{Auth::User()->id}}'
            },
            mounted() {
                axios.get("{{route('api.posts.likes', ['id' => $post->id])}}").then(response=>{
                        this.likesText = "Likes: " + response.data;
                    }).catch(response=>{
                        console.log(response);
                    });
            },
            methods: {
                incLikes:function() {
                    this.promises = [];
                    axios.post("{{route('api.posts.likes.up')}}", { id: this.p_id, user_id: this.u_id }).then(response=>{
                        this.promises.push(axios.get("{{route('api.posts.likes', ['id' => $post->id])}}").then(response=>{
                            this.likesText = "Likes: " + response.data;
                        }).catch(response=>{
                            console.log(response);
                        }));
                    }).catch(response=>{
                        console.log(response);
                    })
                    Promise.all(this.promises).then(response=>{
                        console.log(this.likesText);
                    });
                },
                decLikes:function() {
                    this.promises = [];
                    axios.post("{{route('api.posts.likes.down')}}", { id: this.p_id, user_id: this.u_id }).then(response=>{
                        this.promises.push(axios.get("{{route('api.posts.likes', ['id' => $post->id])}}").then(response=>{
                            this.likesText = "Likes: " + response.data;
                        }).catch(response=>{
                            console.log(response);
                        }));
                    }).catch(response=>{
                        console.log(response);
                    });
                    Promise.all(this.promises).then(response=>{
                        console.log(this.likesText);
                    })
                }
            }
        });

    </script>

@endsection
