<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title></title>
    <style media="screen">
          html,body {
            height: 100%;
          }
    </style>
  </head>
  <body style="height:100vh; width:100vw;">
    <div class="d-flex eao-vote-header">
      <span class="display-4">Bitte verifiziere Dich!</span>
    </div>
    <div class="eao-vote-content">
      <div class="container-fluid h-100 w-100 d-inline-block px-0 mx-0">
        <div class="row h-90 w-100 px-0 mx-0">
          <div class="col d-flex">

            <div class="row w-100 h-5 align-self-center">
              <div class="mx-auto">
                <p>Bitte gebe deinen Geburtstag ein um dich zu verifizieren.</p>
                <div class="mx-auto">
                  <input type="number" name="" value="" placeholder="16" class="form-less">.<input type="number" name="" value=""placeholder="12" class="form-less">.<input type="number" name="" value=""placeholder="2000" class="form-less">
                </div>

              </div>
            </div>
          </div>

        </div>
        <div class="row h-10 w-100 px-0 mx-0">
          <button type="button" name="button" class="btn btn-primary btn-lg btn-block px-0 mx-0">Zur Abstimmung</button>
        </div>
      </div>
    </div>

    <div class="d-flex eao-vote-footer">
      <span>Schulsprecherwahl STS Walddórfer</span>
    </div>
  </body>
</html>
