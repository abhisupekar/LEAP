@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
     </br>
        <h1>Departments</h1>
     </br></br>
     <table class="table table-condensed" id="dept-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
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
        j('#dept-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{url('/')}}/department/process-data',
            columns: [
                {
                    data: 'id',
                    visible:false,
                    searchable: false
                },
                {
                    data: 'name'
                }
            ],
            "order": [[ 0, "desc" ]],
            "pagingType": "simple_numbers"
        });
    });
    </script>