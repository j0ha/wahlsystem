@component('mail::message')
# Election invitation

Hi {{$voter->name}} {{$voter->surname}}!<br>
<br>
Du wurdest zu der Wahl "{{$election->name}}" eingeladen. Die E-Mail ist deine Anleitung wie Du an dieser Wahl teilnimmst und deine Stimme abgibst.

@component('mail::button', ['url' => $route])
Jetzt teilnehmen
@endcomponent

# So kannst du wählen:
@component('mail::panel')
<b>Variante 1:</b> Du klickst oben auf den Knopf "Jetzt teilnehmen" und kannst sofort deine Stimme abgeben.
<br>
<br>
<b>Variante 2:</b> Du besuchst einer der Wahlpunkte und wählst dort nicht-digital.
<br>
<br>
<b>Variante 3:</b> Im Anhang befindet sich ein Dokument, welches Du dir ausdrucken und mit dem QR-Code abstimmen kannst.

@endcomponent

Viel Spaß beim wählen,<br>
{{ config('app.name') }}
<br>
<br>
<br>
<br>
<div style="text-align: center;">
  {{ QrCode::size(200)->generate($route) }}
</div>
@endcomponent
