<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid">
      <h1>Schulsprecherwahl 2020</h1>
      <div class="card">
        <div class="card-header">
          <h3>Wahlbogen für Johannes Schur</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h4>Wahldaten</h4>
              <div class="">
                <strong>Wahlname</strong>Schulsprecherwahl 2020
              </div>
              <div class="">
                <strong>Wahlzeitraum</strong> 11:11 20.11.2020 bis 17:00 20.11.2020
              </div>
              <div class="">
                <strong>Wahlbeaufsichtigung:</strong> Andreas Dressel
              </div>
              <hr>
              <h4>Wähler</h4>
              <div class="">
                <strong>Name:</strong> Johannes Schur
              </div>
              <div class="">
                <strong>Klasse:</strong> 11b
              </div>
              <div class="">
                <strong>Jahrgang:</strong>11
              </div>
              <div class="">
                <strong>Teilname via:</strong>Email, Dierekt, Terminal
              </div>

            </div>

            <div class="col">
              <h4>Direktzugang via QR-Code</h4>
              <div class="mx-auto d-block">
                {!! QrCode::size(200)->generate('moinsenkljsrhflashjrfglkaejhgiaeurgeuiahglawirhugaeirhglaeruhgilaeuhgl'); !!}
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
          Erstellt am 20.11.2020 um 07:56 Uhr für Johannes Schur
        </div>

      </div>
    </div>
  </body>
</html>
