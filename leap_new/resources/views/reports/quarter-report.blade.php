<!DOCTYPE html>

<html lang="en">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

  <!-- <link rel="stylesheet" href="./css/bootstrap.min.css"> -->

  <style>
 /* Bootstrap css */
 html {
  font-family: sans-serif;
  -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
}
body {
  margin: 0;
}
h1,
h2,
h3,
h4,
h5,
h6,
.h1,
.h2,
.h3,
.h4,
.h5,
.h6 {
  font-family: inherit;
  font-weight: 500;
  line-height: 1.1;
  color: inherit;
}
h1,
.h1,
h2,
.h2,
h3,
.h3 {
  margin-top: 20px;
  margin-bottom: 10px;
}

h1,
.h1 {
  font-size: 36px;
}
h2,
.h2 {
  font-size: 30px;
}
h3,
.h3 {
  font-size: 24px;
}
h4,
.h4 {
  font-size: 18px;
}
h5,
.h5 {
  font-size: 14px;
}
h6,
.h6 {
  font-size: 12px;
}
p {
  margin: 0 0 10px;
}
strong {
  font-weight: bold;
}
.text-success {
  color: #3c763d;
}
.text-center {
  text-align: center;
}
.container-fluid {
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}
.row {
  margin-right: -15px;
  margin-left: -15px;
}

.row:after {
  clear: both;
}

.row:before,
.row:after {
 display: table;
  content: " ";
}

.text-primary {
  color: #337ab7;
}
.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
  position: relative;
  min-height: 1px;
  padding-right: 15px;
  padding-left: 15px;
}
.col-xs-1, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9, .col-xs-10, .col-xs-11, .col-xs-12 {
  float: left;
}

@media (min-width: 992px) {
  .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
    float: left;
  }
}

@media (min-width: 768px) {
  .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
    float: left;
   }
  }
 .col-md-3, .col-sm-3, .col-xs-3 {
    width: 25%;
  }

table {
  background-color: transparent;
}
.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 20px;
}

.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: 1px solid #ddd;
}
.table > thead > tr > th {
  vertical-align: bottom;
  border-bottom: 2px solid #ddd;
}
.table > caption + thead > tr:first-child > th,
.table > colgroup + thead > tr:first-child > th,
.table > thead:first-child > tr:first-child > th,
.table > caption + thead > tr:first-child > td,
.table > colgroup + thead > tr:first-child > td,
.table > thead:first-child > tr:first-child > td {
  border-top: 0;
}
.table > tbody + tbody {
  border-top: 2px solid #ddd;
}
.table .table {
  background-color: #fff;
}

.table-bordered {
  border: 1px solid #ddd;
}
.table-bordered > thead > tr > th,
.table-bordered > tbody > tr > th,
.table-bordered > tfoot > tr > th,
.table-bordered > thead > tr > td,
.table-bordered > tbody > tr > td,
.table-bordered > tfoot > tr > td {
  border: 1px solid #ddd;
}
.table-bordered > thead > tr > th,
.table-bordered > thead > tr > td {
  border-bottom-width: 2px;
}

    .table-custom {
            border-radius: 5px;
            width: 60%;
            margin: 0px auto;
            float: none;
        }
        table.table-bordered {
            border:1px solid #000;
            margin-top:20px;
          }
        table.table-bordered > thead > tr > th {
            border:1px solid #000;
        }
        table.table-bordered > tbody > tr > td {
            border:1px solid #000;
        }
        .page-break {
            page-break-after: always;
        }
        .container-fluid {
          width: 100%;
          height:100%;
        }

/* ends */

    .table-custom {
            border-radius: 5px;
            width: 80%;
            margin: 0px auto;
            float: none;
        }
        table.table-bordered{
            border:1px solid #000;
            margin-top:20px;
          }
        table.table-bordered > thead > tr > th{
            border:1px solid #000;
        }
        table.table-bordered > tbody > tr > td{
            border:1px solid #000;
        }


        .container-fluid {
              padding-right: 15px;
              padding-left: 15px;
              margin-right: auto;
              margin-left: auto;
            }
            .row {
              margin-right: -15px;
              margin-left: -15px;
            }
            .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
              position: relative;
              min-height: 1px;
              padding-right: 15px;
              padding-left: 15px;
            }

            .col-xs-1, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9, .col-xs-10, .col-xs-11, .col-xs-12 {
              float: left;
            }
            .col-xs-12 {
              width: 100%;
            }
            .col-xs-11 {
              width: 91.66666667%;
            }
            .col-xs-10 {
              width: 83.33333333%;
            }
            .col-xs-9 {
              width: 75%;
            }
            .col-xs-8 {
              width: 66.66666667%;
            }
            .col-xs-7 {
              width: 58.33333333%;
            }
            .col-xs-6 {
              width: 50%;
            }
            .col-xs-5 {
              width: 41.66666667%;
            }
            .col-xs-4 {
              width: 33.33333333%;
            }
            .col-xs-3 {
              width: 25%;
            }
            .col-xs-2 {
              width: 16.66666667%;
            }
            .col-xs-1 {
              width: 8.33333333%;
            }
            table {
  background-color: transparent;
  font-size: 16px;
}
caption {
  padding-top: 8px;
  padding-bottom: 8px;
  color: #777;
  text-align: left;
}
th {
  text-align: left;
}
table {
  background-color: transparent;
}
caption {
  padding-top: 8px;
  padding-bottom: 8px;
  color: #777;
  text-align: left;
}
th {
  text-align: left;
}
.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 20px;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: 1px solid #ddd;
}
.table > thead > tr > th {
  vertical-align: bottom;
  border-bottom: 2px solid #ddd;
}
.table > caption + thead > tr:first-child > th,
.table > colgroup + thead > tr:first-child > th,
.table > thead:first-child > tr:first-child > th,
.table > caption + thead > tr:first-child > td,
.table > colgroup + thead > tr:first-child > td,
.table > thead:first-child > tr:first-child > td {
  border-top: 0;
}
.table > tbody + tbody {
  border-top: 2px solid #ddd;
}
.table .table {
  background-color: #fff;
}
.table-condensed > thead > tr > th,
.table-condensed > tbody > tr > th,
.table-condensed > tfoot > tr > th,
.table-condensed > thead > tr > td,
.table-condensed > tbody > tr > td,
.table-condensed > tfoot > tr > td {
  padding: 5px;
}
.table-bordered {
  border: 1px solid #ddd;
}
.table-bordered > thead > tr > th,
.table-bordered > tbody > tr > th,
.table-bordered > tfoot > tr > th,
.table-bordered > thead > tr > td,
.table-bordered > tbody > tr > td,
.table-bordered > tfoot > tr > td {
  border: 1px solid #ddd;
}
.table-bordered > thead > tr > th,
.table-bordered > thead > tr > td {
  border-bottom-width: 2px;
}
.table-striped > tbody > tr:nth-of-type(odd) {
  background-color: #f9f9f9;
}
.table-hover > tbody > tr:hover {
  background-color: #f5f5f5;
}
table col[class*="col-"] {
  position: static;
  display: table-column;
  float: none;
}
table td[class*="col-"],
table th[class*="col-"] {
  position: static;
  display: table-cell;
  float: none;
}
.table > thead > tr > td.active,
.table > tbody > tr > td.active,
.table > tfoot > tr > td.active,
.table > thead > tr > th.active,
.table > tbody > tr > th.active,
.table > tfoot > tr > th.active,
.table > thead > tr.active > td,
.table > tbody > tr.active > td,
.table > tfoot > tr.active > td,
.table > thead > tr.active > th,
.table > tbody > tr.active > th,
.table > tfoot > tr.active > th {
  background-color: #f5f5f5;
}
.table-hover > tbody > tr > td.active:hover,
.table-hover > tbody > tr > th.active:hover,
.table-hover > tbody > tr.active:hover > td,
.table-hover > tbody > tr:hover > .active,
.table-hover > tbody > tr.active:hover > th {
  background-color: #e8e8e8;
}
.table > thead > tr > td.success,
.table > tbody > tr > td.success,
.table > tfoot > tr > td.success,
.table > thead > tr > th.success,
.table > tbody > tr > th.success,
.table > tfoot > tr > th.success,
.table > thead > tr.success > td,
.table > tbody > tr.success > td,
.table > tfoot > tr.success > td,
.table > thead > tr.success > th,
.table > tbody > tr.success > th,
.table > tfoot > tr.success > th {
  background-color: #dff0d8;
}
.table-hover > tbody > tr > td.success:hover,
.table-hover > tbody > tr > th.success:hover,
.table-hover > tbody > tr.success:hover > td,
.table-hover > tbody > tr:hover > .success,
.table-hover > tbody > tr.success:hover > th {
  background-color: #d0e9c6;
}
.table > thead > tr > td.info,
.table > tbody > tr > td.info,
.table > tfoot > tr > td.info,
.table > thead > tr > th.info,
.table > tbody > tr > th.info,
.table > tfoot > tr > th.info,
.table > thead > tr.info > td,
.table > tbody > tr.info > td,
.table > tfoot > tr.info > td,
.table > thead > tr.info > th,
.table > tbody > tr.info > th,
.table > tfoot > tr.info > th {
  background-color: #d9edf7;
}
.table-hover > tbody > tr > td.info:hover,
.table-hover > tbody > tr > th.info:hover,
.table-hover > tbody > tr.info:hover > td,
.table-hover > tbody > tr:hover > .info,
.table-hover > tbody > tr.info:hover > th {
  background-color: #c4e3f3;
}
.table > thead > tr > td.warning,
.table > tbody > tr > td.warning,
.table > tfoot > tr > td.warning,
.table > thead > tr > th.warning,
.table > tbody > tr > th.warning,
.table > tfoot > tr > th.warning,
.table > thead > tr.warning > td,
.table > tbody > tr.warning > td,
.table > tfoot > tr.warning > td,
.table > thead > tr.warning > th,
.table > tbody > tr.warning > th,
.table > tfoot > tr.warning > th {
  background-color: #fcf8e3;
}
.table-hover > tbody > tr > td.warning:hover,
.table-hover > tbody > tr > th.warning:hover,
.table-hover > tbody > tr.warning:hover > td,
.table-hover > tbody > tr:hover > .warning,
.table-hover > tbody > tr.warning:hover > th {
  background-color: #faf2cc;
}
.table > thead > tr > td.danger,
.table > tbody > tr > td.danger,
.table > tfoot > tr > td.danger,
.table > thead > tr > th.danger,
.table > tbody > tr > th.danger,
.table > tfoot > tr > th.danger,
.table > thead > tr.danger > td,
.table > tbody > tr.danger > td,
.table > tfoot > tr.danger > td,
.table > thead > tr.danger > th,
.table > tbody > tr.danger > th,
.table > tfoot > tr.danger > th {
  background-color: #f2dede;
}
.table-hover > tbody > tr > td.danger:hover,
.table-hover > tbody > tr > th.danger:hover,
.table-hover > tbody > tr.danger:hover > td,
.table-hover > tbody > tr:hover > .danger,
.table-hover > tbody > tr.danger:hover > th {
  background-color: #ebcccc;
}
.table-responsive {
  min-height: .01%;
  overflow-x: auto;
}
.text-primary {
  color: #337ab7;
}
a.text-primary:hover,
a.text-primary:focus {
  color: #286090;
}
.row {
  margin-right: -15px;
  margin-left: -15px;
}
.row:before,
.row:after {
  display: table;
  content: " ";
}
.row:after {
  clear: both;
}
@media (min-width: 1300px) {
  .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
    float: left;
  }
  .col-md-12 {
    width: 100%;
  }
  .col-md-11 {
    width: 91.66666667%;
  }
  .col-md-10 {
    width: 83.33333333%;
  }
  .col-md-9 {
    width: 75%;
  }
  .col-md-8 {
    width: 66.66666667%;
  }
  .col-md-7 {
    width: 58.33333333%;
  }
  .col-md-6 {
    width: 50%;
  }
  .col-md-5 {
    width: 41.66666667%;
  }
  .col-md-4 {
    width: 33.33333333%;
  }
  .col-md-3 {
    width: 25%;
  }
  .col-md-2 {
    width: 16.66666667%;
  }
  .col-md-1 {
    width: 8.33333333%;
  }
}
.text-center {
  text-align: center;
}
@media (min-width: 768px) {
  .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
    float: left;
  }
  .col-sm-12 {
    width: 100%;
  }
  .col-sm-11 {
    width: 91.66666667%;
  }
  .col-sm-10 {
    width: 83.33333333%;
  }
  .col-sm-9 {
    width: 75%;
  }
  .col-sm-8 {
    width: 66.66666667%;
  }
  .col-sm-7 {
    width: 58.33333333%;
  }
  .col-sm-6 {
    width: 50%;
  }
  .col-sm-5 {
    width: 41.66666667%;
  }
  .col-sm-4 {
    width: 33.33333333%;
  }
  .col-sm-3 {
    width: 25%;
  }
  .col-sm-2 {
    width: 16.66666667%;
  }
  .col-sm-1 {
    width: 8.33333333%;
  }
}
@media (min-width: 1200px) {
  .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12 {
    float: left;
  }
  .col-lg-12 {
    width: 100%;
  }
  .col-lg-11 {
    width: 91.66666667%;
  }
  .col-lg-10 {
    width: 83.33333333%;
  }
  .col-lg-9 {
    width: 75%;
  }
  .col-lg-8 {
    width: 66.66666667%;
  }
  .col-lg-7 {
    width: 58.33333333%;
  }
  .col-lg-6 {
    width: 50%;
  }
  .col-lg-5 {
    width: 41.66666667%;
  }
  .col-lg-4 {
    width: 33.33333333%;
  }
  .col-lg-3 {
    width: 25%;
  }
  .col-lg-2 {
    width: 16.66666667%;
  }
  .col-lg-1 {
    width: 8.33333333%;
  }
}

  </style>
</head>

<body>

  

<div class="container-fluid" style="background-color: #e6e6fa">
  <div>  
    <div class="row" style="margin-top: 20px">
        <div class="col-md" align="center">
            <img src="./images/parkar-logo.png" class="img-responsive"/>
        </div>
    </div>
    <hr style="border:1px solid black;color: blue">
  </div> 
  <div>
        <div class="row"> 
            <div class="col-xs col-sm col-md" style="color: #002266" align="center"><strong>
                <h3>L E A P ( L E A D . E N E R G I Z E . A C C E L E R A T E . P E R F O R M )</h3>
                <h4>PERFORMANCE ASSESSMENT – {{$quarter->name}} – SCORE CARD DURATION: {{$quarter->start_date}} – {{$quarter->end_date}}  {{$quarter->year}}</h4>
              </strong>
            </div>
        </div>
        <hr style="border:1px solid black">
    </div>

    <div>
        <div class="row">
            <div>
                <div class="col-xs-2 col-sm-2 col-md-2">
                    <h4><u><strong>EMPLOYEE ID:</strong></u></h4>
                    <h4><u><strong>DESIGNATION:</strong></u></h4>
                    <h4><u><strong>EMPLOYEE BAND:</strong></u></h4>
                    <h4><u><strong>ROLE:</strong></u></h4>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <h4><strong>{{$user['employee_code']}}</strong></h4>
                    <h4><strong>{{$user['designation']}}</strong></h4>
                    <h4><strong>--</strong></h4>
                    <h4><strong>{{$user['role_name']}}</strong></h4>
                </div>
            </div>
            <div>
                <div class="col-xs-2 col-sm-2 col-md-2">
                    <h4><u><strong>EMPLOYEE NAME:</strong></u></h4>
                    <h4><u><strong>JOINING DATE:</strong></u></h4>
                    <h4><u><strong>GROUP:</strong></u></h4>
                    <h4><u><strong>LEVEL 1 MANAGER:</strong></u></h4>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <h4><strong>{{$user['first_name']}} {{$user['last_name']}}</strong></h4>
                    <h4><strong>{{$user['joining_date']}}</strong></h4>
                    <h4><strong>{{$user['department_name']}}</strong></h4>
                    <h4><strong>{{$user['manager_name']}}</strong></h4>
                </div>
            </div>
        </div>
        <hr style="border:1px solid black">
    </div>
   
    
    <div>
        <div class="row">
            <div class="text-center">
                <div>
                    <h4><u><strong>FINAL RATING REPORT</strong></u></h4>
                </div>
            </div>
            <div class="row" style="padding-left: 20px">
                <div class="col-xs-4 col-sm-4 col-md-4">
                        <h4 style="color: #002266;font-size: 20px;"><strong><i>INDIVIDUAL SCORE:</i></strong></h4>
                        <h4 style="color: #002266;font-size: 20px;"><strong><i>HIGHEST SCORE, PEER GROUP:</i></strong></h4>
                        <h4 style="color: #002266;font-size: 20px;"><strong><i>PEER GROUP:</i></strong></h4>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5">
                        <h4 class="font-weight-bold"><strong>{{$total_score}}</strong></h4>
                        <h4 class="font-weight-bold"><strong>{{$highest_total_score}}</strong></h4>
                        <h4 class="font-weight-bold"><strong>{{$peer_groups}}</strong></h4>
                </div>
            </div>
        </div>
        <hr style="border:1px solid black">
    </div>

    <div>
        <div class="row" style="height: 93%">
            <div class="text-center">
                <h4><u><strong>WEIGHTAGES FOR REFERENCE</strong></u></h4>
            </div>
        
            <div>
                <table class="table table-bordered table-custom">
                    <thead style="background-color: #696969">
                        <tr style="color: white">
                            <th class="col-md-1">KEY COMPONENTS</th>
                            @foreach($weightages['roles'] as $role)
                            <th class="col-md-1">{{$role}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($weightages['weightages'] as $kpi => $weight)
                        <tr>
                            <td>{{$kpi}}</td>
                            @foreach($weight as $value)
                            <td>{{$value}}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr style="border:1px solid black">
    </div>

<div class="page-break"></div>

    <div style="width:100%;">
        @foreach($subkpi_score as $kpi => $weight)
            <div style="width: 100%; height: 93%">
                <div>
                    <div class="row" style="margin-left: 25px">
                            <div class="col-xs-5 col-sm-5 col-md-5">
                                <br>
                                <h3 class="text-primary" style="color: #002266; font-size: 20px;"><strong><i>{{strtoupper($kpi)}} SCORE:</i></strong></h3>
                                <h3 class="text-primary" style="color: #002266; font-size: 20px;"><strong><i>HIGHEST SCORE (PEER GROUP):</i></strong></h3>
                                <br>
                            </div>
                            <div>
                                <br>
                                <h4 class="font-weight-bold"><strong>{{$kpi_score[$kpi]}}</strong></h4>
                                <h4 class="font-weight-bold"><strong>{{$highest_kpi_score[$kpi]}}</strong></h4>
                                <br>
                            </div>
                    </div>
                    <div class="row">
                        <table style="width: 90%" class="table table-bordered" align="center">
                            <thead>
                                <tr>
                                    <th class="col-md-3"><u>PARAMETERS</u></th>
                                    <th class="col-md-3"><u>ASSOCIATE INDIVIDUAL SCORE</u></th>
                                    <th class="col-md-3"><u>HIGHEST SCORE (PEER GROUP)</u></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($weight as $value)
                                <tr>
                                    <td><strong>{{$value['name']}}</strong></td>
                                    <td>{{$value['weight']}}</td>
                                    <td>{{$highest_subkpi_score[$kpi][$value['name']]}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr style="border:1px solid black">
            <div class="page-break"></div>
        @endforeach
    </div>
</div>
</body>
</html>

​
