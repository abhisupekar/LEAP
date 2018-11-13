<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\DB as DB;

class User extends Authenticatable
{
	use Notifiable;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'email', 'password', 'joining_date', 'employee_code', 'designation', 'manager_id', 'department_id', 'role_id', 'status'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function manager()
    {
        return $this->belongsTo('App\Models\User', 'manager_id');
    }

    public function submissionStatus()
    {
        return $this->belongsTo('\App\Usersubmissionstatus', 'user_id');
    }

    /**
     * Helper function to get current employee details
     */
    public static function getEmployeeDetails()
    {  
        if (Auth::user()) {
           $users = DB::table('users')
           ->join('users as manager', 'users.manager_id', '=', 'manager.id')
           ->leftjoin('roles', 'users.role_id', '=', 'roles.id')
           ->leftjoin('departments', 'users.department_id', '=', 'departments.id')
           ->select('users.id as id', 'users.employee_code', 'users.first_name', 'users.last_name', 'users.email', DB::raw('CONCAT(manager.first_name, " ",manager.last_name) as manager_name'), 'roles.name as role_name', 'departments.name as department_name')
           ->get();
           return (object) $users;
        }

       return redirect()->guest('login');
    }
    /**   
     * Helper function to get current employee manager
     */
    public static function getEmployeeManager()
    {
        if (Auth::user()) {
           $manager = DB::table('users')
           ->join('users as manager', 'users.manager_id', '=', 'manager.id')
           ->where('users.id', '=', Auth::user()->id)
           ->get(['manager.id as manager_id', 'manager.first_name', 'manager.last_name', 'manager.email'])->first();
           return (object) $manager;
        }

        return redirect()->guest('login');
    }
}
