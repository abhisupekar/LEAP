@component('mail::message')
<strong>Dear {{$details['manager']->first_name}} {{$details['manager']->last_name}},</strong></br>

<p>Appraisee <strong>{{$details['user']->first_name}} {{$details['user']->last_name}}</strong> submitted evaluation for this Quarter.</p>

<p>Please click <a href="{{url('/manager/dashboard')}}">Dashboard</a> link to see the status of his/her submission.</p>
</br>
Regards,
<div>Team Leap</div>
@endcomponent
