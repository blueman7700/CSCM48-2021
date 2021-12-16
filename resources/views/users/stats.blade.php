@extends('layouts.main')

@section('title')
    User Stats
@endsection

@section('content')

    @php
        $totalLikes = 0;
        $totalViews = 0;
        $PTLRatio = 0.0;
        foreach ($user->posts as $post) {
            $totalLikes += $post->likedUsers->count();
            $totalViews += $post->userViews->count();
        }

        if($user->posts->count() > 0) {
            $PTLRatio = $totalLikes / $user->posts->count();
        }
        
        
    @endphp

    <div class="conteiner-fluid justify-content-center text-center">
        <h2 class="mt-4"><b>Your Statistics</b></h2>

        <p class="mt-4">Total posts: {{$user->posts->count()}}</p>
    
        <p>Total comments: {{$user->comments->count()}}</p>
    
        <p>Total posts viewed: {{$user->viewedPosts->count()}}</p>
    
        <p>Total likes: {{$totalLikes}}</p>
    
        <p>Total views on your posts: {{$totalViews}}</p>
    
        <p>Post-to-like ratio: {{$PTLRatio}}</p>
    </div>

@endsection