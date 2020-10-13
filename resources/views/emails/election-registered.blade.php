@component('mail::message')
Dear {{ $user->name }},
<br>
Congratulations you've just created a new Election - "{{ $election->name }}"!

<h2>Election Details:</h2>
Participants: {{ $election->participants }}
<br>
Abstention-Mode: @if($election->abstention === 1) Acitvated @else False @endif
<br>
Status: @if($election->status === 1) Active @else Offline @endif
<br>
Type: {{ $election->type }}

<table>
<tr>
<th>Links</th>
@foreach ($voter as $tv)
<tr>
<td>
<a href="#">{{env('APP_URL')}}/{{ $tv->direct_token }}</a>
</td>
</tr>
@endforeach
</tr>

</table>




@component('mail::button', ['url' => '<!-- Later the Link to the users backend-->'])
Configurate More
@endcomponent

Thanks for trusting in our service,<br>
{{ config('app.name') }}
@endcomponent
