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
    <div>
        <h3>Comments:</h4>
        <form action="POST" action="">
            <div class="container row text-center justify-content-center">
                <input type="text" id="comment_text" name="comment_text" class="form-control col-sm-8">
                <button type="submit" class="btn btn-primary col-sm-1">add</button>
            </div>
        </form>
    </div>
    <div id="comments">
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
                promises: []
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
            }
        })

    </script>

@endsection
