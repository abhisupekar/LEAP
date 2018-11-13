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
				{!! BootForm::open(['url' => url('/export-records/submissions'), 'method' => 'post']) !!}
				
				<h1>Export Reports</h1>
				<label class="control-label">Select Department</label>
				<select class="form-group form-control" name="department" required>
					<option value="">- Select -</option>
					@foreach ($departments as $department)
						  <option value="{{ $department->id }}">{{ $department->name }}</option> 
					@endforeach
				</select>

				<label class="control-label">Select Quarter</label>
				<select class="form-group form-control" name="quarter" required>
				<option value="">- Select -</option>
					@foreach ($quarters as $quarter)
						  <option value="{{ $quarter->id }}">{{ $quarter->name }}</option> 
					@endforeach
				</select>

				<label class="control-label">Select Year</label>
				<select class="form-group form-control" name="year" required>
				<option value="">- Select -</option>
					@foreach ($years as $year)
						  <option value="{{ $year->year }}">{{ $year->year }}</option> 
					@endforeach
				</select>
		
		
				{!! BootForm::submit('Export Report', ['class' => 'btn btn-primary']) !!}
	   			{!! BootForm::close() !!}
	   			<p><i><b>Note:</b> If you are exporting reports for Q4 then make sure to select next year.</i></p>
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