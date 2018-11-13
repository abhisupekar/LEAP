@extends('layouts.blank')

@push('stylesheets')

<!-- jQuery -->

    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('main_container')
    <!-- page content -->
    <div class="right_col" id="evaluation-form" role="main">
        <table class="table table-condensed">
            <form name="evaluation" id="evaluation" method="POST" action="save">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="employee_id" name="employee_id" value="{{$employee_id}}">
                <input type="hidden" id ="submission_status_id" name="submission_status_id" value="">
                @foreach($data as $key => $kpis)
                    <tr class="kpi-name"><th colspan='4'><h2>{{$key}}</h2></th></tr>
                    <tr class="header-row">
                        <th width='20%'>Sub KPI</th> 
                        <th width='30%'>Description</th> 
                        <th width='15%'>Rating</th>
                        <th width="05%"></th> 
                        <th width='30%'>Comment</th>  
                    </tr>
                    @foreach($kpis as $kpi)
                        <tr>
                            <td><span class="subkpi">{{$kpi['subkpi_name']}}</span></td>
                            <td><span>{{$kpi['subkpi_description']}}</span></td>
                            
                            @if ($kpi['subkpi_min_val'] == 0.00 and $kpi['subkpi_max_val'] == 0.00)
                                <td>
                                    {!! BootForm::number($kpi['kpi_id'].'_'.$kpi['subkpi_id'].'_rating', '', old($kpi['kpi_id'].'_'.$kpi['subkpi_id'].'_rating'), ['placeholder' => 'Rating','class' => 'form-control', 'required' => true, 'step'=> '0.01']) !!}
                                </td>    
                                <td>
                                    <i class="fa fa-info-circle info-pad" title="No Rating Range"></i>
                                </td>
                            @else
                                <td>
                                    {!! BootForm::number($kpi['kpi_id'].'_'.$kpi['subkpi_id'].'_rating', '', old($kpi['kpi_id'].'_'.$kpi['subkpi_id'].'_rating'), ['placeholder' => 'Rating','class' => 'form-control', 'required' => true, 'step'=> '0.01', 'min'=> $kpi['subkpi_min_val'], 'max' => $kpi['subkpi_max_val']]) !!}
                                </td>   
                                <td>
                                    <i class="fa fa-info-circle info-pad" title="{{$kpi['subkpi_name']}} Rating Range: {{$kpi['subkpi_min_val']}} to {{$kpi['subkpi_max_val']}}"></i>
                                </td> 
                            @endif
                            <td>{!! BootForm::textarea($kpi['kpi_id'].'_'.$kpi['subkpi_id'].'_description', '', old($kpi['kpi_id'].'_'.$kpi['subkpi_id'].'_description'), ['placeholder' => 'Description', 'class' => 'form-control', 'required' => true, 'rows' => 1, 'cols' => 1]) !!}
                            </td>
                        </tr>

                    @endforeach
                @endforeach
                
            </form>
             
        </table>
        @if($data)
            <tr><button class="btn btn-primary" id="evl-ajax-process" type="button" form="evaluation" value="Submit">Save as a Draft</button></tr>
            <tr><button class="btn btn-primary" type="submit" form="evaluation" value="Submit">Submit your Appraisal</button></tr>
        @endif    
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