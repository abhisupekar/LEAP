<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use App\Department as Department;
use App\Http\Controllers\Controller;
use DataTables;

class DepartmentController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
           return view('department.department');
        } 
        return redirect()->guest('login');
    }

    public function redirectToDepartmentList() 
    {
        if (Auth::user()) {
            return view('department.departments-list');
        }
        return redirect()->guest('login');
    }

    public function list() 
    {
        if (Auth::user()) {
            $departments = Department::select(['id', 'name']);
            return Datatables::of($departments)->make();
        }
        return redirect()->guest('login');
    }
    
    public function create(Request $request)
    {
        if (Auth::user()) {
            $department = new Department;
            $department->name = $request->name;
            $status = $department->save();
            if ($status) {
                return redirect()->route('departmentList');
            }
        }
        return redirect()->guest('login');

    }

}
