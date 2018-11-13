@extends('layouts.blank')

@push('stylesheets')
   
@endpush

@section('main_container')
	<div class="right_col" role="main">
		<div class="login_wrapper">
			<section class="login_content">
				{!! BootForm::open(['url' => url('/submit-subkpi'), 'method' => 'post']) !!}
				
				<h1>Add Sub KPI</h1>

				{!! BootForm::text('name', 'Sub KPI Name', old('name'), ['placeholder' => 'Sub KPI Name', 'required' => true]) !!}
				
				{!! BootForm::textarea('description', 'Description', old('description'), ['placeholder' => 'Description','rows'=>3, 'required' => true]) !!}
				
				<label class="control-label">KPI</label>
				{!! Form::select('kpis', $kpis, 'null',  ['class' => 'form-group form-control', 'required' => true])!!}
				<label class="control-label">Department</label>
				{!! Form::select('department[]', $departments, 'null',  ['class' => 'form-group form-control', 'required' => true, 'multiple' => 'multiple'])!!}

				{!! BootForm::number('min', 'Min value', old('min'), ['placeholder' => 'Min value', 'required' => true, 'step'=> '0.01']) !!}

				{!! BootForm::number('max', 'Max value', old('max'), ['placeholder' => 'Max value', 'required' => true, 'step'=> '0.01']) !!}
					
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