@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
        <br/>
        <h1>Your Team</h1>
        <br/><br/>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Quarter</th>
                    <th>Role</th>
                    <th>Department</th>
                    <th>Submission Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($managerEmployees as $employee)
                    <tr>
                        <form name="{{$employee->id}}" action="/list/check-submission" method="POST">
                            <td>{{$employee->first_name}}</td>
                            <td>{{$employee->last_name}}</td>
                            <td>{{$employee->email}}</td>
                            <td>{{$employee->quarter_name}}</td>
                            <td>{{$employee->role_name}}</td>
                            <td>{{$employee->department_name}}</td>
                            <td>
                                @if($employee->submission_status)
                                    {{$employee->submission_status}}
                                @else
                                    Submission pending by Appraisee
                                @endif
                            </td>
                            <input type="hidden" name="employee_id" id="employee_id" value="{{$employee->id}}"/>
                            <input type="hidden" name="quarter_id" id="quarter_id" value="{{$employee->quarter_id}}"/>
                            <input type="hidden" name="submission_status_id" id="submission_status_id" value="{{$employee->submission_status_id}}"/>
                            <input type="hidden" name="submission_review_comment_id" id="submission_review_comment_id" value="{{$employee->submission_review_comment_id}}"/>

                            <td>
                                @if($employee->submission_status and $employee->submission_status_id != $draft_status_id)
                                    <button class="btn btn-primary" type="submit">View Submission</button>
                                @else
                                    <button class="btn btn-primary" disabled type="submit">View Submission</button>
                                @endif
                            </td> 
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
