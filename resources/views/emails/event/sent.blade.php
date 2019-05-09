@component('mail::message')

Dear <b>{{explode(' ', $name)[0]}}</b>,

Thank you for choosing to attend the AFF Disrupt Conference 2019.

Please present the QR code below at the entrance of the event to gain access to the event.

The event will hold on the 16th of May at the Landmark Event Centre (plot 2 & 3, Water Corporation Drive, Victoria Island). Please be punctual, the event will start at 8am prompt.

Also, lso, to enjoy 50% off your taxify ride on the event day, follow us on Instagram <b><a href="https://instagram.com/africafintechfoundry">@africafintechfoundry</a></b> and on Twitter <b><a href="https://twitter.com/@AFFoundry">@AFFoundry</a></b> as the discount codes will be posted on the platforms.

And be sure to use the #affdisrupt2019 hashtag for the event.

For further enquiries, please contact Oluwaseyi at <a href="mailto:oluwaseyi.balogun@africafintechfoundry.com">oluwaseyi.balogun@africafintechfoundry.com</a>

We look forward to welcoming you at the event.

Thank you,<br>
{{ config('app.name') }}
@endcomponent
