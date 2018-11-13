@component('mail::message')
<strong>Dear {{$details['user']->first_name}} {{$details['user']->last_name}},</strong>
<p>Your submission is approved by <strong>L1, {{$details['manager']->first_name}} {{$details['manager']->last_name}}</strong> for this quarter. You will get notify as <strong>HR</strong> approves your submission.</p>
</br>
Regards,
Team Leap
@endcomponent