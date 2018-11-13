<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\DB as DB;
use App\Models\User;
use App\Usersubmissionstatus;
use App\Submission;
use App\Department;
use App\Quarter;
use App\Submissionreviewcomment;
use \Carbon\Carbon;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function getManagerEmployees() {
    	if (Auth::user()) {
    		$managerEmployees = DB::table('users')
            ->leftJoin('user_submission_status', 'users.id', '=', 'user_submission_status.user_id')
            ->leftjoin('status', 'user_submission_status.status_id', '=', 'status.id') 
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->leftJoin('quarters', 'user_submission_status.quarter_id', '=', 'quarters.id')
            ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
            ->where('manager_id','=', Auth::user()->id)
            ->where('role_id','!=', 5)
            ->get(['users.*','roles.name AS role_name', 'departments.name AS department_name', 'user_submission_status.id AS submission_review_comment_id', 'user_submission_status.status_id AS submission_status_id', 'status.name AS submission_status','quarters.id as quarter_id', 'quarters.name as quarter_name']);

            return view('manager.dashboard', ['managerEmployees' => $managerEmployees, 'draft_status_id' => config('constant.status.SUBMISSION_DRAFT')]);
    	}
        return redirect()->guest('login');   
    }

    public function checkEmployeeSubmission(Request $request) {
        if (Auth::user()) {
            if ($_POST) {
                $disabled = $this->isDisabled();
                $selfEdit = false; 
                $adminEdit = false;
                if (Auth::user()->id == $_POST['employee_id'] &&
                    ($_POST['submission_status_id'] == 5 || $_POST['submission_status_id'] == config('constant.status.SUBMISSION_DRAFT'))) {
                    $disabled = '';
                    $selfEdit = true;
                }

                if(Auth::user()->role_id == 5 && $_POST['submission_status_id'] == 3) {
                    $adminEdit = true;
                }
                $appraise = User::where('id','=', $_POST['employee_id'])->first();
                $submission = Submission::fetchSubmission($_POST['employee_id'], $_POST['quarter_id']);
                $reviewComments = Submissionreviewcomment::Where('submission_status_id', $_POST['submission_review_comment_id'])->orderBy('id', 'desc')->get();
                return view('list.check-submission', ['employeeId' => $request['employee_id'], 'data' => $submission, 'submission_status_id' => $request['submission_status_id'], 'submission_review_comment_id' => $request['submission_review_comment_id'], 'reviewComments' => $reviewComments, 'disabled' => $disabled, 'appraise' => $appraise, 'selfEdit' => $selfEdit, 'adminEdit' => $adminEdit, 'employeeId' => $request['employee_id']]);
            }
            else {
                return redirect('/');
            }
        }
        return redirect()->guest('login');
    }

    public function isDisabled() {
        $disabled = 'disabled';
        if (Auth::user()->role_id == 5) {
            $disabled = '';
            return $disabled;
        }
        return $disabled;
    }
}
