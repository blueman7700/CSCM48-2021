@extends('layouts.main')

@section('title')
    Posts
@endsection

@section('content')

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

<div id="posts">
    <div class="container d-flex">
        <div class="col d-felx align-items-center justify-content-center">
            <div class="col-sm-6 mx-auto" v-for="p in p_data">
                <a class=card :href="'/post/' + p.post.id">
                    <div class=card-body>
                        <h4 class=card-title>@{{p.post.title}}</h4>
                        <p class=card-text>@{{p.post.content}}</p>
                        <div class=row>
                            <div class="col-sm">
                                <p>likes: @{{p.post.num_likes}}</p>
                            </div>
                            <div class="col-sm-8">
                                <p>posted: @{{p.post.date_of_creation}}</p>
                            </div>
                        </div>
                        <p>posted by: @{{p.uname}}</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    var app = new Vue({
        el: "#posts",
        data: {
            p_data: [],
            promises: [],
            count: 0
        },
        mounted() {
            axios.get("/api/posts").then(response => {
                const posts = response.data;
                this.count = posts.length;
                this.promises = posts.map(post => {
                    axios.get("/api/users/" + post.user_id).then(response=>{
                        const u = {uname: response.data.name, post: post}
                        this.p_data.push(u);
                    }).catch(response=>{
                        console.log(response);
                    })
                })
            }).catch(response => {
                console.log(response);
            });
            Promise.all(this.promises).then(data=>{
                console.log(this.p_data);
            })
        }
    });
</script>

@endsection

