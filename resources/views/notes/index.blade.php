<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    dashboard
    <form method="POST" action="{{route('logout')}}">
        @csrf
        @method('DELETE')
        <button class="btn btn-secondary">Log out</button>
    </form>
</body>
</html>