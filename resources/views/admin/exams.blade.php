<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<body>
    @component('components.navbar')@endcomponent
    <h1>Exams Page</h1>
    <h2>Levels</h2>
    <ul>
        @foreach($levels as $level)
        <li><a href="{{route('admin-level', ['level_id' => $level->id])}}">{{$level->name}}</a></li>
        @endforeach
    </ul>
</body>
</html>