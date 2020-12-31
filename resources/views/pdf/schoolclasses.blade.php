<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container" style="width: 21cm; height: 29.7cm;">
    <h1 class="mb-4">{{$election->name}}</h1>
    <h3>Schoolclasses</h3>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Form</th>
        </tr>
        </thead>
        <tbody>
        @foreach($schoolclasses as $schoolclass)
            <tr>
                <th scope="col">{{$schoolclass->name}}</th>
                @php
                    $formName = App\Form::where('id', $schoolclass->form_id)->get('name');
                @endphp
                <th scope="col">{{$formName[0]->name}}</th>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
