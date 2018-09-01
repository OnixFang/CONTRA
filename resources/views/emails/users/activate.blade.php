@component('mail::message')
# Bienvenido {{ $user->full_name }}

The body of your message.
{{ "Tu codigo de activacion es: ". $user->activate_code  }}

@component('mail::button', ['url' => route('login.activate', $user->salt)])
Activar Cuenta
@endcomponent


@component('mail::header', ['url' => route('login.activate', $user->salt)])
{{ config('app.name') }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
