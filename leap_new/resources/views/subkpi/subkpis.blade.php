@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
        </br>
        <h1>Subkpis</h1>
        </br></br>
        <table class="table table-condensed" id="subkpi-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>KPI Name</th>
                    <th>Department Name</th>
                    <th>Min Value</th>
                    <th>Max Value</th>
                    <th>Action</th>
                </tr>
            </thead>
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
<script src="{{ asset("js/jquery.min.js") }}"></script>
<script src="https://datatables.yajrabox.com/js/jquery.dataTables.min.js"></script>
<script src="https://datatables.yajrabox.com/js/datatables.bootstrap.js"></script>
<script>
    var j = $.noConflict();
     j(function() {
        j('#subkpi-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{url('/')}}/subkpi-data',
             columns: [
                {
                    data: 'id', name: 'id',
                    visible:false,
                    searchable: false
                },
                {
                    data: 'name', name: 'name'
                },
                {
                    data: 'description', name: 'description'
                },
                {
                    data: 'kpi_name', name: 'kpi_name'
                },
                {
                    data: 'department_name', name: 'department_name'
                },
                {
                    data: 'min', name: 'min'
                },
                {
                    data:'max', name: 'max'
                },
                {   data: 'action', name: 'action',
                     orderable: false,
                     searchable: false
                }
            ],
            "order": [[ 0, "desc" ]],
            "pagingType": "simple_numbers",
            "lengthMenu": [[25, 50, -1], [25, 50, "All"]]
        });
    });
</script>


