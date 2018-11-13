@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('main_container')
    <!-- page content -->
    <div class="right_col" role="main">
        <br/>
        <h1>Your Submissions</h1>
        <br/><br/>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Quarter</th>
                    <th>Role</th>
                    <th>Department</th>
                    <th>Manager</th>
                    <th>Submission Status</th>
                    <th>Action</th>
                    <th>Report</th>
                </tr>
            </thead>
            <tbody>
                @if($self)
                    @foreach($self as $employee)
                        <tr>
                            <form name="{{$employee->id}}" action="/list/check-submission" method="POST"><td>{{$employee->first_name}}</td>
                            <td>{{$employee->last_name}}</td>
                            <td>{{$employee->email}}</td>
                            <td>{{$employee->quarter_name}}</td>
                            <td>{{$employee->role_name}}</td>
                            <td>{{$employee->department_name}}</td>
                            <td>{{$employee->manager_fname}} {{$employee->manager_lname}}</td>
                            <td>@if($employee->submission_status)
                            {{$employee->submission_status}}
                            @else
                                Submission pending by Appraisee
                            @endif</td>
                            <input type="hidden" name="employee_id" id="emp_id" value="{{$employee->id}}"/>
                            <input type="hidden" name="quarter_id" id="quarter_id" value="{{$employee->quarter_id}}"/>
                            <input type="hidden" name="submission_status_id" id="submission_status_id" value="{{$employee->submission_status_id}}"/>
                            <input type="hidden" name="submission_review_comment_id" id="submission_review_comment_id" value="{{$employee->submission_review_comment_id}}"/>
                            <td>
                                @if($employee->submission_status) 
                                    <button class="btn btn-primary" type="submit">View Submission</button></td>
                                @else
                                    <button class="btn btn-primary" disabled type="submit">View Submission</button></td>
                                @endif   
                            </form>
                            <form name="{{$employee->id}}_report" action="/report" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="quarter" id="quarter" value="{{$employee->quarter_name}}"/>
                            <input type="hidden" name="department" id="department" value="{{$employee->department_name}}"/>
                            <input type="hidden" name="year" id="year" value="{{date('Y', strtotime($employee->created_at))}}"/>
                            <td>
                                <!-- Check if a report is generated already for logged in user
                                We need to figure out a way to determine the naming convention
                                of a report, speicifically year-->
                                @if (file_exists(public_path()."/files/reports/{$employee->first_name}{$employee->last_name}_{$employee->employee_code}_{$employee->quarter_name}_{$employee->department_name}_2017.pdf"))
                                    <button class="btn btn-primary" type="submit">View Report</button>
                                @endif
                            </td>
                            </form>
                        </tr>
                    @endforeach
                @else 
                    You don't have any previous submissions.
                @endif
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