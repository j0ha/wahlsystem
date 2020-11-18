<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PDF</title>

  </head>
  <style>
    *{
      margin: 0;
      padding: 0;
    }
    .main {
      width: 100vw;
      height: 100vh;
    }

    .header {
      position: absolute;
      top: 0;
      left: 0;
      height: 15%;
      width: 100%;
      background-color: red;
    }

    .qr {
      position: absolute;
      top: 3%;
      right: 4%;
    }

    .footer {
      position: absolute;
      bottom: 0;
      left: 0;
      height: 5%;
      width: 100%;
      background-color: grey;
    }
  </style>
  <body>
    <div class="main">
      <div class="header">
        <div class="info">
          <h1>Schulsprecherwahl STSWA</h1>
          <h2>Zugang für Johannes Schur</h2>
        </div>
        <div class="qr">
            {!! QrCode::size(200)->generate('Moinsen Moinsen Moinskejfhlwjfhkljhfklajhfklajhflkajshfklh'); !!}
        </div>
      </div>
      <div class="content">

      </div>
      <div class="footer">

      </div>
    </div>
  </body>
</html>
