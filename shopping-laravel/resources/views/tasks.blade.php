<!doctype html>
<html >
<head>
</head>
<body>
<ul>
    @foreach ($tasks as $task)
        <li>
            A
            <a href="tasks/{{$task->id}}">
            {{ $task->body }}
            </a>
        </li>
    @endforeach
</ul>

</body>
</html>
