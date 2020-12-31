<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container" style="width: 29.7cm; height: 21cm;">
    <h1 class="mb-4">{{$election->name}}</h1>
    <h3>Terminals</h3>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Kind</th>
            <th scope="col">Position</th>
            <th scope="col">Time</th>
            <th scope="col">IP-Restriction</th>
            <th scope="col">URL</th>
        </tr>
        </thead>
        <tbody>
        @foreach($terminals as $terminal)
            <tr>
                <th scope="col">{{$terminal->name}}</th>
                <th scope="col">{{$terminal->description}}</th>
                <th scope="col">{{$terminal->kind}}</th>
                <th scope="col">{{$terminal->position}}</th>
                <th scope="col">{{$terminal->start_time}} - {{$terminal->end_time}}</th>
                <th scope="col">{{$terminal->ip_restriction}}</th>
                <th scope="col">@if($terminal->kind != config('terminalkinds.email.short')) {{route('vote', ['electionUUID'=>$election->uuid, 'terminalUUID'=>$terminal->uuid])}} @else
                        - @endif</th>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
