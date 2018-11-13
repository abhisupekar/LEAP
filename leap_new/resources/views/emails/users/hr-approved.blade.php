@component('mail::message')
<strong>Dear {{$details['user']->first_name}} {{$details['user']->last_name}},</strong></br>

<p>Your submission approved by <strong>HR</strong> for this quarter. Thank you for submitting evaluation.</p>
</br>
Regards,
<div>Team Leap</div>
@endcomponent