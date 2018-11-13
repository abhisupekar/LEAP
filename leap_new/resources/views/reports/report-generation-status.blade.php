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
                        @if ($diff == 0)
                            <h4>Ready to Go. </h4>
                            <strong>Are you ready to calculate score of the users?</strong></br></br>
                            <form name="score-calcuation-conform" action="/list/check-submission" method="POST">
                                <button class="btn btn-primary" type="submit">Calculate</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="redirectToReportGeneration();">Close</button>
                            </form>
                        @elseif ($diff >0)
                            <h4>{{$diff}} More Submission Required. </h4>
                            <strong>Are you ready to calculate score of the users?</strong></br></br>
                             <form name="score-calcuation-conform" action="/list/check-submission" method="POST">
                                <button class="btn btn-primary" type="submit">Calculate</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="redirectToReportGeneration();">Close</button>
                            </form>
                        @elseif($diff < 0)
                            <h4>Submissions are more than Users exists in system. </h4>
                            <strong>We can not run scoring, Please contact admin for further details.</strong></br></br>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="redirectToReportGeneration();">Close</button>
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

        function redirectToReportGeneration() {
            window.location.href = '/reports/report-generation'
        }
    </script>