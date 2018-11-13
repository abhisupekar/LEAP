@component('mail::message')
<strong>Dear {{$details['user']->first_name}} {{$details['user']->last_name}},</strong></br>

<p>Your submission saved successfully for this quarter. You will get notify as, <strong>L1, {{$details['manager']->first_name}} {{$details['manager']->last_name}}</strong> approves your submission.</p>

Regards,<div>Team LEAP</div>
@endcomponent