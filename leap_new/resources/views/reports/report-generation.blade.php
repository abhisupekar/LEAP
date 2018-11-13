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
				{!! BootForm::open(['url' => url('/score-generation'), 'method' => 'post']) !!}
				
				<h1>Report Generation</h1>
				
				<label class="control-label">Select Quarter</label>
				<select class="form-group form-control" name="quarter" required>
					@foreach ($quarters as $quarter)
						  <option value="{{ $quarter->id }}">{{ $quarter->name }}</option> 
					@endforeach
				</select>

				<label class="control-label">Select Year</label>
				<select class="form-group form-control" name="year" required>
					@foreach ($years as $year)
						  <option value="{{ $year->year }}">{{ $year->year }}</option> 
					@endforeach
				</select>
		
		
				{!! BootForm::submit('Run Report', ['class' => 'btn btn-primary']) !!}
	   			{!! BootForm::close() !!}
	   			<p><i><b>Note:</b> If you are running reports for Q4 then make sure to select current running year.</i></p>
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