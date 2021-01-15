<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <livewire:styles>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>

  <body class="eao-vote-body">
    @livewire('vote', ['electionUUID' => $electionUUID, 'terminalUUID' => $terminalUUID, 'directUUID' => $directUUID])

    <livewire:scripts>
    </body>

    </html>
