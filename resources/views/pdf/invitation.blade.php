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
      <div class="card">
        <div class="card-header">
          <h3>Wahlbogen für {{$voter->name}} {{$voter->surname}}</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h4>Wahldaten</h4>
              <div class="">
                <strong>Wahlname</strong> {{$election->name}}
              </div>
              <div class="">
                <strong>Wahlzeitraum</strong> @if($election->activeby == null)Steinzeit @else {{$election->activeby}}@endif bis @if($election->activeto == null)Trumpszweitepräsidentschaft @else {{$election->activeto}}@endif
              </div>
              <div class="">
                <strong>Wahlbeaufsichtigung:</strong> {{$election->permission_id}}
              </div>
              <hr>
              <h4>Wähler</h4>
              <div class="">
                <strong>Name:</strong> {{$voter->name}} {{$voter->surname}}
              </div>
              <div class="">
                <strong>Klasse:</strong> {{$voter->schoolclass_id}}
              </div>
              <div class="">
                <strong>Jahrgang:</strong> {{$voter->form_id}}
              </div>
              <div class="">
                <strong>Teilname via:</strong>Email, Dierekt, Terminal
              </div>
              <hr>
              <div class="text-center my-4">
                <h2 class="mb-3">Direktzugang via QR-Code</h2>

              <div class="mx-auto d-block">
                {{ QrCode::size(200)->generate($route) }}
              </div>

            </div>
            </div>
          </div>
          <div class="card-body border-top mt-3">
            <div class="text-center">
              <h2>Wahlanleitung</h2>
            </div>
            <p>Diese drei Möglichkeiten sehen dir zu verfügung um in dieser Wahl deine Stimme abzugeben:</p>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Variante 1:</strong> Du scannst den QR-Code, oben rechts, mit deinem Gerät und stimmst auf der sich öffnenden Webseite ab.</li>
                <li class="list-group-item"><strong>Variante 2:</strong> Du hast per E-Mail einen Link geschickt bekommen, mit welchem du Abstimmen kannst.</li>
                <li class="list-group-item"><strong>Variante 3:</strong> Du begibst dich zu einem der Wahlpunkte und wählst dort nicht-digital.</li>
              </ul>
            </div>

        </div>
        <div class="card-footer text-muted">
          Erstellt am {{date('d.m.Y')}} um {{date('H:i:s')}} Uhr für {{$voter->name}} {{$voter->surname}}
        </div>

      </div>
    </div>
  </body>
</html>
