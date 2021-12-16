<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width-device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        
        <title>Core::Dump</title>
    </head>
    <body>
        <div>
            <h1>{{$user_to->name}}</h1>
            <p>{{$user_from->name}} has commented on your post '{{$post->title}}' saying: 
                {{$content}}</p>
        </div>
    </body>
</html>