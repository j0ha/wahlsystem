@component('mail::message')
# Election helpinvitation

Hello Dear {{$user->name}} {{$user->surname}},<br>
<br>
You got invited to help at the election: "{{$election->name}}". This email is to wheter confirm or decline this request.

@component('mail::button', ['url' => $route])
Accept now
@endcomponent

@endcomponent
