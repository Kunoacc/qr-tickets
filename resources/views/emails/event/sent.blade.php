@component('mail::message')
# Introduction

Hello {{explode($name, ' ')[0]}}

Your event qr code has been attached below

Thanks,<br>
{{ config('app.name') }}
@endcomponent
