@component('mail::message')
# Welcome

You are registered his site 

Name: {{ $user->name }}
@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
