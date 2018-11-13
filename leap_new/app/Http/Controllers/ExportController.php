<?php

namespace App\Http\Controllers;

use DB;
use App\Quarter;
use App\Department;
use Illuminate\Http\Request;

class ExportController extends Controller
{

	/* Export Records Template*/
	public function index() {
		$departments = Department::all();
		$quarters = Quarter::all();
        $years = DB::table('submissions')
                ->select(DB::raw('YEAR(created_at) as year'))
                ->distinct()
                ->orderBy('year', 'desc')
                ->get();

        return view('export.export-reports', ['departments' => $departments, 'quarters' => $quarters, 'years' => $years]);
	}

	/*Export Data*/
	public function export(Request $request){    
		//print_r($request->quarter);
		//print_r($request->department);
		//print_r($request->year);
		//exit;  
		DB::statement('SET SESSION group_concat_max_len = 1000000');
		DB::statement('SET @sql = NULL');
	   	$records = DB::select("SELECT GROUP_CONCAT(CONCAT('MAX(if('submissions.subkpi_id' = 'id', 'submissions.rating', 0)) as 'name') separator ',') INTO @sql FROM subkpis ORDER BY id ASC");
	   	DB::statement("SET @sql = CONCAT('SELECT u.employee_code as `Emp code`, CONCAT(u.first_name," ",u.last_name) as `Employee Name`, u.designation as `Designation`, IF(u.joining_date IS NOT NULL, DATE_FORMAT(u.joining_date, "%d-%b-%y"), NULL) as `DOJ`, dept.name as `Group`, roles.name as `Role`, CONCAT(manager.first_name," ",manager.last_name) as `L1` , status.name as `Submission Status` , ',@sql,' FROM submissions LEFT JOIN users u ON (u.id = submissions.user_id) LEFT JOIN users manager ON (manager.id = u.manager_id) LEFT JOIN subkpis ON (subkpis.id = submissions.subkpi_id) LEFT JOIN departments dept ON (dept.id = u.department_id) LEFT JOIN roles ON (roles.id = u.role_id) LEFT JOIN user_submission_status ON (user_submission_status.user_id = u.id) LEFT JOIN status ON (status.id = user_submission_status.status_id) WHERE submissions.quarter_id = 4 GROUP BY u.id')");
	   		DB::statement('PREPARE stmt FROM @sql');
	   		DB::statement('EXECUTE stmt');
	   		DB::statement('DEALLOCATE PREPARE stmt');
	    print_r($records);
	    exit;
	    $tot_record_found=0;
	    if(count($records)>0){
	        $tot_record_found=1;
	         
	        $CsvData=array('Emp Code,Name,Role,Manager,Department,KPI,Total Score');          
	        foreach($records as $value){              
	            $CsvData[]=$value->Emp_Code.','.$value->Name.','.$value->Role.','.$value->Manager.','.$value->Department.','.$value->KPI.','.$value->Total_Score;
	        }
	         
	        $filename=date('Y-m-d').".csv";
	        $file_path=base_path().'/'.$filename;   
	        $file = fopen($file_path,"w+");
	        foreach ($CsvData as $exp_data){
	          fputcsv($file,explode(',',$exp_data));
	        }   
	        fclose($file);          
	 
	        $headers = ['Content-Type' => 'application/csv'];
	        return response()->download($file_path,$filename,$headers );
	    }
	    
	}
}
