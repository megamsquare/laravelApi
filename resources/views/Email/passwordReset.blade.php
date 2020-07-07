@component('mail::message')
# Change Password Request

Welcome to Testing.

@component('mail::button', ['url' => ''])
Click to Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
