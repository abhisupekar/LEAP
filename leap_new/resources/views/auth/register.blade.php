@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
	<div class="right_col" role="main">
		<div class="login_wrapper">
			<section class="login_content">
				{!! BootForm::open(['url' => url('/register'), 'method' => 'post']) !!}
				
				<h1>Register User</h1>

				{!! BootForm::text('name', 'First Name', old('first_name'), ['placeholder' => 'First Name']) !!}
				
				{!! BootForm::text('middle_name', 'Middle Name', old('middle_name'), ['placeholder' => 'Middle Name']) !!}
				
				{!! BootForm::text('last_name', 'Last Name', old('last_name'), ['placeholder' => 'Last Name']) !!}

				{!! BootForm::email('email', 'Email', old('email'), ['placeholder' => 'Email']) !!}

				<label class="control-label">Date of Joining</label>
				<input type="date" value="yyyy-mm-dd" name="joining_date" id="joining_date" class="form-control">
				<br/>
								
				{!! BootForm::text('employee_code', 'Employee Code', old('employee_code'), ['placeholder' => 'Employee Code']) !!}

				{!! BootForm::text('designation', 'Designation', old('designation'), ['placeholder' => 'Designation']) !!}

				<label class="control-label">Manager</label>
				{!! Form::select('manager', $managers, 'null',  ['class' => 'form-group form-control', 'required' => true])!!}
				<label class="control-label">Department</label>
				{!! Form::select('department', $departments, 'null',  ['class' => 'form-group form-control', 'required' => true])!!}
				<label class="control-label">Role</label>
				{!! Form::select('role', $roles, 'null',  ['class' => 'form-group form-control', 'required' => true])!!}

				{!! BootForm::number('status', 'Active Status', old('status'), ['placeholder' => 'Active Status', 'min'=> 0, 'max' => 1]) !!}
			
				{!! BootForm::submit('Register', ['class' => 'btn btn-primary']) !!}
	   			{!! BootForm::close() !!}
				<div class="clearfix"></div>
			</section>
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