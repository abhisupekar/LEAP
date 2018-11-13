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
				{!! BootForm::open(['url' => url('/user-update'), 'method' => 'post']) !!}
				
				<h1>Update User</h1>

				<input type="hidden" value="{{$temp['id']}}" name="id" id="id" class="form-control">

				<label class="control-label">First Name</label>
				<input type="text" value="{{$temp['name']}}" name="name" id="name" class="form-control" placeholder="First Name" required>
				<br/>			
				
				<label class="control-label">Middle Name</label>
				<input type="text" value="{{$temp['middle_name']}}" name="middle_name" id="middle_name" class="form-control" placeholder="Middle Name">
				<br/>
				
				<label class="control-label">Last Name</label>
				<input type="text" value="{{$temp['last_name']}}" name="last_name" id="last_name" class="form-control" placeholder="Last Name" required>
				<br/>

				<label class="control-label">Email</label>
				<input type="email" value="{{$temp['email']}}" name="email" id="email" class="form-control" placeholder="Email" required>
				<br/>
				
				<label class="control-label">Date of Joining</label>
				<input type="date" value="{{$temp['joining_date']}}" name="joining_date" id="joining_date" class="form-control" required>
				<br/>
								
				<label class="control-label">Employee Code</label>
				<input type="text" value="{{$temp['employee_code']}}" name="employee_code" id="employee_code" class="form-control" placeholder="Employee Code" required>
				<br/>

				<label class="control-label">Designation</label>
				<input type="text" value="{{$temp['designation']}}" name="designation" id="designation" class="form-control" placeholder="Designation">
				<br/>

				<label class="control-label">Manager</label>
				<select class="form-group form-control" name="manager" required>
					@foreach ($managers as $id=>$manager)
						  <option value="{{ $id }}" {{ $temp['manager'] == $id ? 'selected="selected"' : '' }}>{{ $manager }}</option> 
					@endforeach
				</select>
				
				<label class="control-label">Department</label>
				<select class="form-group form-control" name="department" required>
					@foreach ($departments as $id=>$department)
						  <option value="{{ $id }}" {{ $temp['department'] == $id ? 'selected="selected"' : '' }}>{{ $department }}</option> 
					@endforeach
				</select>
		
				<label class="control-label">Role</label>
				<select class="form-group form-control" name="role" required>
					@foreach ($roles as $id=>$role)
						  <option value="{{ $id }}" {{ $temp['role'] == $id ? 'selected="selected"' : '' }}>{{ $role }}</option> 
					@endforeach
				</select>
				
 				<label class="control-label">Active Status</label>
				<input type="number" value="{{$temp['status']}}" name="status" id="status" class="form-control" placeholder="Active Status" min="0" max="1">
				<br/>

				{!! BootForm::submit('Update', ['class' => 'btn btn-primary']) !!}
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