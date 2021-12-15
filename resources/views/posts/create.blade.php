@extends('layouts.main')

@section('title')
    Post Details
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <h2 class="text-center">New Post</h2>
    </div>
    <div class="container-fluid mt-4">
        <form class="mx-4" method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">

            @csrf

            <label class="form-text" for="title">Title:</label>
            <input class="form-control mb-4" type="text" name="title" id="title" placeholder="Title">

            <label class="form-text" for="content">Content:</label>
            <textarea class="form-control mb-4" name="content" id="content" placeholder="Content"></textarea>

            <input class="form-control mb-4" type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.gif">

            <button class="btn btn-primary mb-4 ms-4" type="submit">Post</button>
            <a class="btn btn-danger float-right mb-4 me-4" href="/users/home">Cancel</a>

            <input type="hidden" name="user_id" id="user_id" value="{{Auth::User()->id}}">
        </form>
    </div>
@endsection