@component('mail::message')
# Activate Your Account

Thanks for signing up, please activate your account.

@component('mail::button', ['url' => route('auth.activate', [
     'token' => $user->activation_token,
     'email' => $user->email
          ])
])
   Activate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
