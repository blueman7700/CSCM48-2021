@extends('layouts.main')

@section('title')
    Welcome
@endsection

@section('content')
    
    <div class="d-flex container-fluid text-center justify-content-center mt-4">
        <h1>Welcome to Core::Dump!</h1>
    </div>
    <div class="container-fluid text-center justify-content-center mt-5">
        <div class="row">
            <div class="card col m-5 border-5 border-dark rounded">
                <div class="card-body">
                    <h4 class="card-title">
                        Already have an account?
                    </h4>
                    <a href="/login" class="btn btn-primary">
                        <h4 class=card-title>Log-in</h4>
                    </a>
                </div>
            </div>
            <div class="card col m-5 border-5 border-dark rounded">
                <div class="card-body">
                    <h4 class="card-title">
                        Don't have an account yet?
                    </h4>
                    <a href="/register" class="btn btn-primary">
                        <h4 class=card-title>Sign Up</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection