@extends('layouts.main')

@section('title')
    User Details
@endsection

@section('content')

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

    <div>
        <h1>{{$post->title}}</h2>
    </div>
    <div>
        <p>posted by: {{$post->user->name}} at {{$post->created_at}}</p>
    </div>
    <!-- check if there is an image -->
    <div>
        <p>{{$post->content}}</p>
    </div>
    <div>
        <p>Likes: {{$post->num_likes}}</p>
    </div>

    <div id="comments">
        <h3>Comments:</h4>
        <div class="container-fluid row text-center justify-content-center">
        
            <textarea type="text" id="commentContent" v-model="newCommentContent" class="form-control col-sm-6"></textarea>
            <button class="btn btn-primary col-sm-1" @click="createComment">add</button>
        
            <input type="hidden" id="commentable_id" name="commentable_id" v-model="commentableID" value="{{$post->id}}">
            <input type="hidden" id="user_id" name="user_id" v-model="userID" value="{{Auth::User()->id}}">
            <input type="hidden" id="commentable_type" name="commentable_type" v-model="commentableType" value="{{Post::class}}">
            <input type="hidden" id="user_name" name="user_name" v-model="userName" value="{{Auth::User()->name}}">
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

    </script>

@endsection
