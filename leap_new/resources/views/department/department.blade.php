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
				{!! BootForm::open(['url' => url('/submit-department'), 'method' => 'post']) !!}
				
				<h1>Add Department</h1>

				{!! BootForm::text('name', 'Department Name', old('name'), ['placeholder' => 'Department Name', 'required' => true]) !!}
			
				{!! BootForm::submit('Submit', ['class' => 'btn btn-primary']) !!}
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