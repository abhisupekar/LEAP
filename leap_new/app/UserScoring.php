<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\DB as DB;
use App\Quarter as Quarter;

class UserScoring extends Model
{
    protected $table = 'user_scoring';

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    Public function kpis()
    {
        return $this->belongsTo('App\Kpi', 'kpi_id');
    }

    Public function subkpis()
    {
        return $this->belongsTo('App\Subkpi', 'subkpi_id');
    }

    public function roles()
    {
        return $this->belongsTo('App\Role');
    }

    Public function departments()
    {
        return $this->belongsTo('App\Department');
    }

    Public function quarters()
    {
        return $this->belongsTo('App\Quarters');
    }

    /**
    * Get all users for score calculation
    */
    public static function getUsersScore()
    {
        $currentQuarter = Quarter::getRunningQuarter()->id;
        $users = DB::table('user_scoring')
            ->leftjoin('users', 'users.id', '=', 'user_scoring.user_id')
            ->join('users as manager', 'users.manager_id', '=', 'manager.id')
            ->leftjoin('roles', 'users.role_id', '=', 'roles.id')
            ->leftjoin('departments', 'users.department_id', '=', 'departments.id')
            ->leftjoin('subkpis', 'subkpis.id', '=', 'user_scoring.subkpi_id')
            ->leftjoin('kpis', 'kpis.id', '=', 'user_scoring.kpi_id')
            ->select('users.employee_code', 'users.joining_date', 'users.first_name', 'users.last_name', 'users.email', 'users.designation', DB::raw('CONCAT(manager.first_name, " ",manager.last_name) as manager_name'), 'roles.name as role_name', 'departments.name as department_name', 'user_scoring.*', 'subkpis.name as subkpi', 'kpis.name as kpi')
            ->where('quarter_id', '=', $currentQuarter)
            ->groupBy('subkpis.id', 'users.id')
            ->get()->toArray();
        return $users;
    }


/**
 * Get highest score for individual user
 */
public static function getHighestSubkpiScore($departmentId, $roleID = NULL, $kpiID = NULL, $subkpiID = NULL)
{
  if (empty($departmentId)) {
    return FALSE;
  }

  $currentQuarter = Quarter::getRunningQuarter()->id;
  $where = [['quarter_id', '=', $currentQuarter], ['department_id', '=', $departmentId]];

  // Filter result with role.
  if ($roleID) {
    $where[] = ['role_id', '=', $roleID];
  }

  // Filter result with kpi.
  if ($kpiID) {
    $where[] = ['kpi_id', '=', $kpiID];
  }

  // Filter result with kpi.
  if ($subkpiID) {
    $where[] = ['subkpi_id', '=', $subkpiID];
  }

  $users = DB::table('user_scoring')
    ->select(DB::raw('MAX(score) highest_score'), 'user_id', 'role_id', 'kpi_id', 'subkpi_id', 'department_id')
    ->where($where)
    ->groupBy('subkpi_id')
    ->get()->toArray();

    return $users;
  }

/**
 * Helper function to get highest score for user
 */
    public static function getHighestScore($departmentId, $roleID = NULL, $kpiID = NULL, $userID = NULL, $subkpiID = NULL) 
    {
      if (empty($departmentId)) {
        return FALSE;
      }

    $currentQuarter = Quarter::getRunningQuarter()->id;
    $where = [['quarter_id', '=', $currentQuarter], ['department_id', '=', $departmentId]];
    $groupBy = ['user_id'];

    // Filter result with User ID.
    if ($userID) {
        $where[] = ['user_id', '=', $userID];
    }

    // Filter result with roles
    if ($roleID) {
        $where[] = ['role_id', '=', $roleID];
        $groupBy[] = 'role_id';
    }

    // Filter result with kpi.
    if ($kpiID) {
        $where[] = ['kpi_id', '=', $kpiID];
        $groupBy[] = 'kpi_id';
    }

    // Filter result with Subkpi.
    if ($subkpiID) {
        $where[] = ['subkpi_id', '=', $subkpiID];
    }    

    $scores = DB::table('user_scoring')
            ->select(DB::raw('SUM(score) highest'), 'user_id', 'role_id', 'kpi_id', 'department_id')
            ->where($where)
            ->groupBy($groupBy)
            ->orderBy('highest', 'desc')
            ->get()->first();

    return $scores;
    }
}