<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.partials.head')
    </head>
    <body>
        @include('layouts.partials.nav')

        @if ($errors->any())
            <div>
                Errors:
                <ul>
                    @foreach ($errors->all() as $err)
                        <li>{{$err}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            @yield('content')
        </div>


        @include('layouts.partials.footer')

        @include('layouts.partials.footer-scripts')
        
    </body>
</html>
