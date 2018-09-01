@component('mail::message')
# Bienvenido {{ $user->full_name }}

The body of your message.

@component('mail::button', ['url' => route('profiles')])
Activar Cuenta
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
