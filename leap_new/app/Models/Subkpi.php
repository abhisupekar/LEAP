<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kpi as Kpi;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Auth as Auth;

class Subkpi extends Model
{
    /**
     * The skubkpi that belong to the kpi.
     */
    public $timestamps = false;

    public function kpis() {
        return $this->belongsToMany('App\Kpi', 'kpi_subkpis')->withPivot('department_id');
    }

    public static function getSukpisDetails()
    {
        if (Auth::user()) {
            $subkpiList = DB::table('subkpis')
                ->leftJoin('kpi_subkpis_department', 'subkpis.id', '=', 'kpi_subkpis_department.subkpi_id')
                ->leftJoin('kpis', 'kpi_subkpis_department.kpi_id', '=', 'kpis.id')
                ->leftJoin('departments', 'kpi_subkpis_department.department_id', '=', 'departments.id')
                ->select('subkpis.id as id','subkpis.name as name', 'subkpis.description as description', 'kpis.name as kpi_name', 'subkpis.min as min', 'subkpis.max as max', DB::raw('group_concat(departments.name) as department_name'))
                ->groupBy('subkpis.id')
                ->get();
            return (object) $subkpiList;
        }
        return redirect()->guest('login');
    }
}
