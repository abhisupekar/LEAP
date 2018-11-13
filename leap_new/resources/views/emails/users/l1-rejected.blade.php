@component('mail::message')
<strong>Dear {{$details['user']->first_name}} {{$details['user']->last_name}},</strong></br>
<p>Your submission is rejected by <strong>L1, {{$details['manager']->first_name}} {{$details['manager']->last_name}}</strong>. Please click <a href="{{url('/')}}">Dashboard</a> link to see the status of your submission.</p>
<p>You may have to make the suggested changes and submit your appraisal again.</p>

Regards,
<div>Team LEAP</div>
@endcomponent
