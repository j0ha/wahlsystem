<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    @role('admin')
    <h1>Hello!</h1>
    @else
    I am not a writer...
    @endrole

    @can('test')
    //
    @endcan

  </body>
</html>
