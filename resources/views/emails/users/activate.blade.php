@component('mail::message')
# Bienvenido {{ $user->full_name }}

@component('mail::header', ['url' => url('/')])
{{ config('app.name') }}
@endcomponent

The body of your message.
{{ "Tu codigo de activacion es: ". $user->activate_code  }}

@component('mail::button', ['url' => route('profiles.activate',encrypt($user->activate_code))])
Activar Cuenta
@endcomponent




Thanks,<br>
{{ config('app.name') }}
@endcomponent
