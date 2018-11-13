@component('mail::message')
<strong>Dear HR Team,</strong>
<p>Appraisee <strong>{{$details['user']->first_name}} {{$details['user']->last_name}}</strong> submitted evaluation for this Quarter.Please click <a href="{{url('/manager/dashboard')}}">Dashboard</a> link to see the status of his/her submission.</p>
</br>
Regards,
Team Leap
@endcomponent