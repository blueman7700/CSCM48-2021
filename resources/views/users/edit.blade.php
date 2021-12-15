@extends('layouts.main')

@section('title')
    User Details
@endsection

@section('content')

    <div class="ms-4 mt-4">
        <h2>Your Account</h2>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div>
                    <form method="POST" action="{{route('users.update')}}">
                        @csrf
                        <div class="col mb-4">
                            <label class="form-text" for="editName">Name: </label>
                            <input class="form-control" type="text" id="editName" name="name" value="{{$user->name}}">
                        </div>
                        
                        <div class="col mb-4">
                            <label class="form-text" for="editEmail">Email</label>
                            <input class="form-control" type="text" id="editEmail" name="email" value="{{$user->email}}">
                        </div>
            
                        <button class="btn btn-primary ms-3 mb-4" type="submit">
                            Save Changes
                        </button>
                    </form>
                </div>
            
                <div>
                    <form method="POST" action="{{route('user.password.update')}}">
                        @csrf
                        <div class="col mb-4">
                            <label class="form-text" for="newPassword">New Password:</label>
                            <input class="form-control" type="text" id="newPassword" name="newPassword">
                        </div>
                        <div class="col mb-4">
                            <label class="form-text" for="newPassword">Confirm New Password:</label>
                            <input class="form-control" type="text" id="newPassword" name="confirmPassword">
                        </div>
            
                        <input class="btn btn-primary ms-3 mb-4" type="submit" value="Reset Password">
                    </form>
                </div>
            </div>
            <div class="col"></div>
            <div class="col-4">
                <div class="container-fluid justify-content-center text-center">
                    @if ($user->image != null)
                        <img src="{{asset('storage/'.$user->image->image)}}" alt="" width="250" height="250" class="border border-dark rounded-circle">
                    @else
                        <img src="{{asset("/default.png")}}" alt="" width="250" height="250" class="border border-dark rounded-circle">
                    @endif
                    <form class="mx-4 justify-content-center text-center" method="POST" action="{{route('users.update.image')}}" enctype="multipart/form-data">
                        @csrf
                        <input class="form-control my-4" type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.gif">
                        <button class="btn btn-primary mb-4" type="submit">Change</button>
                    </form>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm">
                <a class="btn btn-danger ms-3 mb-4" href="/logout">
                    Log Out
                </a>
            </div>
            <div class="col-sm-1">

            </div>
            <div class="col-sm-4">
                <div>
                    <form method="POST" action="{{route('users.delete')}}">
                        @csrf
            
                        @method('DELETE')
            
                        <button class="float-right btn btn-danger me-3 mb-4" type="submit">
                            Delete Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
    
        
    </div>
    

@endsection