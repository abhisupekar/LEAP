@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
        </br>
        <h1>Users</h1>
        </br></br>
        <table class="table table-condensed" id="user-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Employee Code</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Manager</th>
                <th>Role</th>
                <th>Department</th>
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
        j('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{url('/')}}/list/users-data',
             columns: [
                {
                    data: 'id', name: 'id',
                    visible:false,
                    searchable: false
                },
                {
                    data: 'employee_code', name: 'employee_code'
                },
                {
                    data: 'first_name', name: 'first_name'
                },
                {
                    data: 'last_name', name: 'last_name'
                },
                {
                    data: 'email', name: 'email'
                },
                {
                    data: 'manager_name', name: 'manager_name'
                },
                {
                    data: 'role_name',name: 'role_name'
                },
                {
                    data: 'department_name', name: 'department_name'
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
