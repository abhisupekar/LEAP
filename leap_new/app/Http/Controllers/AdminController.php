<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\DB as DB;
use App\Models\User;
use App\Submission;
use App\Quarter;
use DataTables;
use App\Department;
use App\Role;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function redirectToUserList()
    {
        return view('list.users');
    }

    public function getAllUsers()
    {
        if (Auth::user()) {
            $users = User::getEmployeeDetails();
            return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return '<form action="/user-edit" method="POST"><input type="hidden" name="_token" value="'.csrf_token() .'"/><input type="hidden" name="user_id" id="user_id" value="'.$user->id.'"/><input type="submit" value ="Edit" class="btn btn-sm btn-primary"/></form>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
        }
        return redirect()->guest('login');
    }

    public function updatePreprocess(Request $request)
    {   $requiredData = RegisterController::formRequiredData();
        $userUpdate = User::find($request->user_id);
        $temp = [];
        $temp['id'] = $request->user_id;
        $temp['name'] = $userUpdate->first_name;
        $temp['middle_name'] = $userUpdate->middle_name;
        $temp['last_name'] = $userUpdate->last_name;
        $temp['email'] = $userUpdate->email;
        $temp['joining_date'] = $userUpdate->joining_date;
        $temp['employee_code'] = $userUpdate->employee_code;
        $temp['designation'] = $userUpdate->designation;
        $temp['manager'] = $userUpdate->manager_id;
        $temp['department'] = $userUpdate->department_id;
        $temp['role'] = $userUpdate->role_id;
        $temp['status'] = $userUpdate->status;

        return view('list.user-update', ['departments' => $requiredData['departments'], 'roles' => $requiredData['roles'], 'managers' => $requiredData['managers'], 'temp' => $temp]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'middle_name' => 'max:255',
            'last_name' => 'required|max:255',
            'manager' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'department' => 'required',
            'role' => 'required',
            'joining_date' => 'required',
            'employee_code' => 'required',
            'designation' =>  'max:255'
        ]);
    }

    public function updateUser(Request $request)
    {
        //$this->validator($request->all())->validate();
        $userToUpdate = User::find($request->id);
        $userToUpdate->first_name = $request->name;
        $userToUpdate->middle_name = $request->middle_name;
        $userToUpdate->last_name = $request->last_name;
        $userToUpdate->email = $request->email;
        $userToUpdate->joining_date = $request->joining_date;
        $userToUpdate->employee_code = $request->employee_code;
        $userToUpdate->designation = $request->designation;
        $userToUpdate->manager_id = $request->manager;
        $userToUpdate->department_id = $request->department;
        $userToUpdate->role_id = $request->role;
        $userToUpdate->status = $request->status;
        $status = $userToUpdate->save();
        if($status)
        {
            return view('list.users');
        }
    }


    public static function getEmployeesSubmissionStatus() {
        if (Auth::user()) {
            $employees = DB::table('users')
            ->leftJoin('user_submission_status', 'users.id', '=', 'user_submission_status.user_id')
            ->join('users as managers', 'users.manager_id', '=', 'managers.id')
            ->leftjoin('status', 'user_submission_status.status_id', '=', 'status.id') 
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->leftJoin('quarters', 'user_submission_status.quarter_id', '=', 'quarters.id')
            ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
            ->where('users.role_id', '!=', 5)
            ->get(['users.id as id', 'users.employee_code as employee_code', 'users.first_name as fname', 'users.last_name as lname', 'users.email','roles.name AS role_name', 'managers.first_name as manager_fname', 'managers.last_name as manager_lname', 'departments.name AS department_name', 'user_submission_status.id AS submission_review_comment_id','user_submission_status.status_id AS submission_status_id', 'status.name AS submission_status','quarters.id as quarter_id','quarters.name as quarter_name']);
            return view('list.submission-status', ['employees' => $employees]);
        }

        return redirect()->guest('login');
    }
}
