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
                        <h4 class="modal-title"  style="color: #fff">Success!</h4>
                    </div>
                    @if(Auth::user()->role_id != 5) 
                        <div class="modal-body">
                        <h4>You have sucessfuly submitted your evaluation for this Quarter.</h4>
                        <strong>Your submission will be reviewed by your reporting manager. You can track the status on your <a href ="/">Dashboard</a>.</strong>
                        @if(!$email_status)
                        <div>The email notification could not be triggered because of a system issue.</div>
                        @endif
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="redirectToDashboard();">Close</button>
                    </div>
                    @else
                        <div class="modal-body">
                        <h4>You have sucessfuly modified the submission.</h4>
                        <strong>You can check the status at <a href ="/list/submission-status">Organization Status</a>.</strong>
                        @if(!$email_status)
                        <div>The email notification could not be triggered because of a system issue.</div>
                        @endif
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="redirectToAdminDashboard();">Close</button>
                    </div>
                    @endif
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

    function redirectToAdminDashboard() {
        window.location.href = '/list/submission-status';
    }

    function redirectToDashboard() {
        window.location.href = '/';
    }
</script>