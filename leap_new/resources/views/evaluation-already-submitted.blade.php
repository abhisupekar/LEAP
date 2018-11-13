@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" id="evaluation-form" role="main">
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

            <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #2A3F54">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"  style="color: #fff">Attention!</h4>
                    </div>
                    <div class="modal-body">
                    @if ($draft)
                        <h4>Your submission is saved as a draft for this Quarter.
                         You can click on view submission button to continue. </h4>
                    @else
                        <h4>You have already submitted your evaluation for this Quarter. </h4>
                        <strong>Your submission is currently under review, please check the status of your submission on dashboard or contact HR team.</strong>
                    @endif
                    </div>
                    <div class="modal-footer">
                    @if ($draft)
                    <form name="{{$employee['id']}}" action="/list/check-submission" method="POST">
                     <input type="hidden" name="employee_id" id="emp_id" value="{{$employee['id']}}"/>
                     <input type="hidden" name="submission_review_comment_id" id="emp_id" value=""/>
                     <input type="hidden" name="quarter_id" id="quarter_id" value="{{$employee['quarter_id']}}"/>
                     <input type="hidden" name="submission_status_id" id="submission_status_id" value="{{$employee['submission_status_id']}}"/>
                     <button class="btn btn-primary" type="submit">View Submission</button>
                     <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="redirectToDashboard();">Close</button>
                    </form>
                    @else
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="redirectToDashboard();">Close</button>
                    @endif
                    </div>
                </div>
            </div>
        </div> 
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(window).on('load',function(){
            $('#myModal').modal('show');
        });

        function redirectToDashboard() {
            window.location.href = '/'
        }
    </script>