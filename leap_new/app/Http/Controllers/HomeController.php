<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Auth as Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $self = DB::table('users')
            ->leftJoin('user_submission_status', 'users.id', '=', 'user_submission_status.user_id')
            ->leftjoin('status', 'user_submission_status.status_id', '=', 'status.id') 
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->leftJoin('quarters', 'user_submission_status.quarter_id', '=', 'quarters.id')
            ->join('users as managers', 'users.manager_id', '=', 'managers.id')
            ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
            ->where('user_id','=', Auth::user()->id)
            ->get(['users.*','roles.name AS role_name', 'departments.name AS department_name', 'user_submission_status.status_id AS submission_status_id', 'user_submission_status.id AS submission_review_comment_id', 'status.name AS submission_status',  'quarters.id as quarter_id','quarters.name as quarter_name','managers.first_name as manager_fname', 'managers.last_name as manager_lname']);
        return view('home', ['self' => $self]);
    }
}
