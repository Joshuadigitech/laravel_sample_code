<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>    
    <ul class="chat">                        
        <strong class="primary-font">
            Contacts<br><br>
        </strong>
        @foreach($users as $user)
        <a href="{{ url('chat/'.$user->id) }}">{{ $user->first_name }} {{$user->last_name}}</a>
        <hr>
        @endforeach
    </ul>    
</body>
</html>