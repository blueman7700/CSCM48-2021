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

    <div class="container-fluid justify-content-center text-center">
        <h1 class="mt-4"><b>Your Statistics</b></h1>

        <div class="container-fluid ms-4 me-4">
            <div class="row mb-4">
                <div class="col text-center">
                    <p class="mt-4 fs-3">Total posts: {{$user->posts->count()}}</p>
                </div>
                <div class="col text-center">
                    <p class="mt-4 fs-3">Total comments: {{$user->comments->count()}}</p>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col text-center">
                    <p class="fs-3">Total posts viewed: {{$user->viewedPosts->count()}}</p>
                </div>
                <div class="col text-center">
                    <p class="fs-3">Total views on your posts: {{$totalViews}}</p>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col text-center">
                    <p class="fs-3">Total likes: {{$totalLikes}}</p>
                </div>
                <div class="col text-center">
                    <p class="fs-3">Post-to-like ratio: {{$PTLRatio}}</p>
                </div>
            </div>
        </div>

        
    
        
    
        
    
        
    
        
    
        
    </div>

@endsection