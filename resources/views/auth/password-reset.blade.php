<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Reset</title>
</head>
<body>
<form action="{{route('password.update')}}" method="POST">
    <input type="email" name="email">
    <input type="hidden" name="token" value="{{$token}}">
    <input type="password" name="password">
    <input type="password" name="password_confirmation">
</form>
</body>
</html>
