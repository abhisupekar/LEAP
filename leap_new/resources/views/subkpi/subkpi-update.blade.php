@extends('layouts.blank')

@push('stylesheets')
   
@endpush

@section('main_container')
	<div class="right_col" role="main">
		<div class="login_wrapper">
			<section class="login_content">
				{!! BootForm::open(['url' => url('/subkpi-update'), 'method' => 'post']) !!}
				
				<h1>Update Sub KPI</h1>

				<input type="hidden" value="{{$temp['id']}}" name="id" id="id" class="form-control">
				
				<label class="control-label">Sub KPI Name</label>
				<input type="text" value="{{$temp['name']}}" name="name" id="name" class="form-control" placeholder="Sub KPI Name" required>
				<br/>

				<label class="control-label">Description</label>
				<textarea name="description" id="description" class="form-control" placeholder="Description" rows="3" required>{{$temp['description']}}</textarea>
				<br/>

				<label class="control-label">KPI</label>
				<select class="form-group form-control" name="kpis" required>
					@foreach ($kpis as $id=>$kpi)
						  <option value="{{ $id }}" {{ $temp['kpi_id'] == $id ? 'selected="selected"' : '' }}>{{ $kpi }}</option> 
					@endforeach
				</select>
				
				<label class="control-label">Department</label>
				<select class="form-group form-control" multiple="multiple" name="department[]" required>
					@foreach ($departments as $id=>$department)
						  <option value="{{ $id }}" {{ in_array($id, $temp['departments']) ? 'selected="selected"' : '' }}>{{ $department }}</option> 
					@endforeach
				</select>
				
				<label class="control-label">Min value</label>
				<input type="number" value="{{$temp['min']}}" step="0.01" name="min" id="min" class="form-control" placeholder="Min value" required>
				<br/>

				<label class="control-label">Max value</label>
				<input type="number" value="{{$temp['max']}}" step="0.01" name="max" id="max" class="form-control" placeholder="Max value" required>
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