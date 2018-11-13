<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subkpi as Subkpi;

class Kpi extends Model
{
    /**
     * The kpi that belong to the subkpi.
     */
     public function subkpis() {
        return $this->belongsToMany('App\Subkpi', 'kpi_subkpis')->withPivot('department_id');
    }
    

    public static function getDetails() 
    {
        //$deptKpis = SELF::getDepartmentKPIs();
        $i = 0;
        //foreach($deptKpis as $kpi) {
        $store = [];
        $kpis = Subkpi::find();
        echo '<pre>';
        //print_r($kpi);
        exit;
        foreach (Kpi::with('subkpis')->get() as $kpi) {
                //echo '<pre>';
                //print_r($kpi);
                $store[$i]['kpi_id'] = $kpi->id;
                $store[$i]['subkpi_id'] = $kpi->id; 
                $store[$i]['subkpi_name'] = $kpi->name;
                $store[$i]['subkpi_description'] = $kpi->description;
                //$store[$i]['department_id'] = $kpi->pivot->department_id;
                $i++;
            }
      echo '<pre>';
      print_r($store);
    }

    public function getDetail() {
      return $this->belongsToMany('App\Subkpi')
        // pass a closure to group your constraints
        ->where(function ($query) {
            return $query->where('kpi_subkpis.department_id', 1);
        })
        ->withPivot('department_id');
    }

    /*public static function getDetails() {
      $departmentKpis = SELF::getDepartmentKPIs();
      $records = SELF::findMany($departmentKpis)->subkpis;
      print_r($records);
    } */       

    private static function getDepartmentKPIs() {
    	$kpis = [];
    	foreach (kpi::where('department_id', 1)->get() as $kpi ){
    		  $kpis[] = $kpi->id;	    	
    	}
    	return $kpis;
    }
}
