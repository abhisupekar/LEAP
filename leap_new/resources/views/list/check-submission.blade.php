@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush
@section('main_container')

    <!-- page content -->
    <div class="right_col" id="evaluation-form" role="main">
        <div class="appraiseName"><h3>{{$appraise->first_name}}
        {{$appraise->last_name}}</h3></div>
        <table class="table table-condensed">
            <form name="evaluation" id="evaluation" method="POST" action="/update">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="submission_status_id" name="submission_status_id" value="{{$submission_status_id}}">
                <input type="hidden" id="submission_review_comment_id" name="submission_review_comment_id" value="{{$submission_review_comment_id}}">
                <input type="hidden" id="employee_id" name="employee_id" value="{{$employeeId}}">
                <input type="hidden" id="modified" name="modified" value="0">
                @foreach($data as $key => $kpis)
                
                    <tr class="kpi-name"><th colspan='4'><h2>{{$key}}</h2></th></tr>
                    <tr class="header-row">
                        <th width='20%'>Sub KPI</th> 
                        <th width='30%'>Description</th> 
                        <th width='15%'>Rating</th> 
                        <th width="05%"></th> 
                        <th width='30%'>Comment</th>
                    </tr>
                    @foreach($kpis as $submission)
                        <tr>
                            <td><span class="subkpi">{{$submission->subkpi_name}}</span></td>
                            <td><span  class="subkpi_desc">{{$submission->subkpi_description}}</span></td>
                            @if ($submission->subkpi_min_val == 0.00 and $submission->subkpi_max_val == 0.00)
                                <td>
                                    <input type="number" id="{{$submission->kpi_id.'_'.$submission->subkpi_id.'_rating'}}" name="{{$submission->kpi_id.'_'.$submission->subkpi_id.'_rating'}}" value="{{$submission->rating}}" class="form-control" onchange = "setModifiedbyHR()" {{$disabled}} step="0.01" required="true">
                                </td>
                                <td>
                                    <i class="fa fa-info-circle info-pad" title="No Rating Range"></i>
                                </td>
                            @else    
                                <td>
                                    <input type="number" id="{{$submission->kpi_id.'_'.$submission->subkpi_id.'_rating'}}" name="{{$submission->kpi_id.'_'.$submission->subkpi_id.'_rating'}}" value="{{$submission->rating}}" class="form-control" onchange = "setModifiedbyHR()" {{$disabled}} step="0.01" min="{{$submission->subkpi_min_val}}" max="{{$submission->subkpi_max_val}}" required="true">
                                </td>
                                <td>
                                    <i class="fa fa-info-circle info-pad" title="{{$submission->subkpi_name}} Rating Range: {{$submission->subkpi_min_val}} to {{$submission->subkpi_max_val}}"></i>
                                </td>
                            @endif
                            <td><textarea id="{{$submission->kpi_id.'_'.$submission->subkpi_id.'_description'}}" name="{{$submission->kpi_id.'_'.$submission->subkpi_id.'_description'}}" class="form-control" rows="1" cols="1" required="true" onchange = "setModifiedbyHR()" {{$disabled}}>{{$submission->description}} </textarea></td>
                        </tr>
                    @endforeach
                @endforeach
                @if($selfEdit)
                   @if($submission_status_id == config('constant.status.SUBMISSION_DRAFT'))
                    <table><tr><button class="btn btn-primary" id = "evl-ajax-process" type="button" form="evaluation" value="Submit" draft_submit = 1>Save as a Draft</button></tr>
                    @endif
                    <tr><button class="btn btn-primary" type="submit" form="evaluation" value="Submit">Submit your Appraisal</button></tr></table>
                @endif
                @if($adminEdit)
                    <table>
                    <tr>
                        <textarea id="review_comment" name="review_comment" rows="5" cols="15" style="min-width: 60%" placeholder="Reviewer Comment..." required></textarea>
                    </tr>
                </table>
                <br/>
                    <table><tr>
                        <button class="btn btn-primary" type="submit" form="evaluation" value="Submit">Approve Submission!</button>
                        <a href = "/list/submission-status" class="btn btn-primary">Cancel!</a>        
                  </tr></table>
                @endif
                <br/>   
            </form> 
        </table>
        @foreach($reviewComments as $reviewComment)
            <div class="list-group">
                <span class="list-group-item list-group-item-action flex-column align-items-start" style="background-color: #425668">
                    <div class="d-flex w-100 justify-content-between" style="color:#fff">
                        @if ($reviewComment->status_id == config('constant.status.L1_APPROVAL_PENDING'))
                            <h5 class="mb-1">Your submission is pending for review by Reporting Manager</h5>
                        @elseif ($reviewComment->status_id == config('constant.status.HR_APPROVAL_PENDING'))
                            <h5 class="mb-1">Your submission is Approved by your Reporting Manager and now is pending with HR Team</h5>
                        @elseif ($reviewComment->status_id == config('constant.status.HR_APPROVED'))
                            <h5 class="mb-1">Your submission is Accepted by HR Team, Ratings will be shared soon.</h5>
                        @elseif ($reviewComment->status_id == config('constant.status.L1_REJECTED'))
                            <h5 class="mb-1">Your submission is Rejected by your Reporting Manager and you need to resubmit it</h5>
                        @elseif ($reviewComment->status_id == config('constant.status.HR_MODIFIED_AND_APPROVED'))
                            <h5 class="mb-1">Your submission was Modified and Accepted by HR Team, Ratings will be shared soon.</h5>    
                        @endif
                        <p class="mb-1">Reviewer Comment : {{$reviewComment->comment}}</p>
                    </div>
                    <p class="mb-1" style="color:#fff">Reviewer : {{$reviewComment->users->first_name}} {{$reviewComment->users->last_name}}</p>
                </span>
            </div>
        @endforeach
            @if ($employeeId != Auth::user()->id && !$adminEdit && Auth::user()->role_id != 5 && $submission_status_id == 2)
                <table>
                    <tr>
                        <textarea id="review_comment" name="review_comment" rows="5" cols="15" style="min-width: 60%" placeholder="Reviewer Comment..." required></textarea>
                    </tr>
                </table>
                <br/>
                @if((Auth::user()->role_id == 3 || Auth::user()->role_id == 4) && $submission_status_id == 2)
                    <tr>
                        <td><button class="btn btn-primary" type="submit" id="accept" onclick="approveSubmission($('#submission_review_comment_id').val(), $('#review_comment').val())">Approve Submission!</button>
                        </td>
                        <td><button class="btn btn-primary" type="submit" onclick="rejectSubmission($('#submission_review_comment_id').val(), $('#review_comment').val())">Reject Submission!</button>
                        </td>
                        <td><a href = "/manager/dashboard" class="btn btn-primary">Cancel!</a>
                        </td>
                    </tr>
                @endif
            @endif   
    </div>

    <!-- /page content -->

    <!-- footer content -->
    <footer>
        <div class="pull-right">
            ©2017 All Rights Reserved.
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
@endsection

<script>
    function approveSubmission(submissionStatuId, reviewComment) {
        $_token = "{{ csrf_token() }}";
        if ($.trim(reviewComment)) {
            if (confirm('Are you sure you want to approve this submission?')) {
                $(".loader-overlay").show();
                $.post('/approve-submission', {id: submissionStatuId, review_comment: reviewComment, _token: $_token})
                .done(function(data)
                {
                    if (data.status == 1) {
                        if (data.email_status == true) {
                            $('#EmailModal .modal-body').html('');
                        }
                        $('#EmailModal .btn-primary').attr('onclick', "window.location.href = '/manager/dashboard'");
                        $('#EmailModal .modal-body').prepend("<h4><strong>You have successfuly accepted the submission</strong></h4>");
                        $('#EmailModal').modal('show');
                    }
                });
            }
        }
        else {
            alert('Please add your comment');
        }
    }

    function approveSubmissionByHR(submissionStatuId, reviewComment) {
        $_token = "{{ csrf_token() }}";
        var form = $('#evaluation').serialize();
        if ($.trim(reviewComment)) {
            if (confirm('Are you sure you want to approve this submission?')) {
                $(".loader-overlay").show();
                $.post('/approve-submission-by-hr', {id: submissionStatuId, review_comment: reviewComment, form:form, _token: $_token})
                .done(function(data)
                {
                    if (data.status == 1) {
                        if (data.email_status == true) {
                            $('#EmailModal .modal-body').html('');
                        }
                        $('#EmailModal .btn-primary').attr('onclick', "window.location.href = '/list/submission-status'");
                        $('#EmailModal .modal-body').prepend("<h4>You have successfuly accepted the submission</h4>");
                        $('#EmailModal').modal('show');
                    }
                });
            }
        }
        else {
            alert('Please add your comment');
        }
    }


    function rejectSubmission(submissionStatuId, reviewComment) {
        $_token = "{{ csrf_token() }}";
        if ($.trim(reviewComment)) {
            if (confirm('Are you sure you want to reject this submission?')) {
                $(".loader-overlay").show();
                $.post('/reject-submission', {id: submissionStatuId, review_comment: reviewComment, _token: $_token})
                .done(function(data)
                {
                    console.log(data);
                    if (data.status == 1) {
                        if (data.email_status == true) {
                            $('#EmailModal .modal-body').html('');
                        }
                        $('#EmailModal .btn-primary').attr('onclick', "window.location.href = '/manager/dashboard'");
                        $('#EmailModal .modal-body').prepend("<h4>You have successfuly rejected the submission</h4>");
                        $('#EmailModal').modal('show');
                    }
                });
            }
        }
        else {
            alert('Please add your comment');
        }
    }

    function setModifiedbyHR() {
        $('#modified').val(1);
    }
</script>