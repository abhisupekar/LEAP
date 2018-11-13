<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subkpi;
use Illuminate\Support\Facades\Auth as Auth;

class Department extends Model
{
    public $timestamps = false;

    public function subkpis() {
        return $this->belongsToMany('App\Subkpi', 'kpi_subkpis_department')->withPivot('kpi_id');
    }

    public function kpis() {
        return $this->belongsToMany('App\Kpi', 'kpi_subkpis_department');
    }

    Public function roles() {
        return $this->belongsToMany('App\Models\User');
    }

    public static function getDetails() {
        $i = 0;
        $store = [];
        foreach (SELF::find(Auth::user()->department_id)->subkpis as $key =>$kpi) {
            $store[$i]['kpi_name'] = Kpi::where('id', $kpi->pivot->kpi_id)->pluck('name')->first();
            $store[$i]['kpi_id'] = $kpi->pivot->kpi_id;
            $store[$i]['subkpi_id'] = $kpi->id; 
            $store[$i]['subkpi_name'] = $kpi->name;
            $store[$i]['subkpi_min_val'] = $kpi->min;
            $store[$i]['subkpi_max_val'] = $kpi->max;
            $store[$i]['subkpi_description'] = $kpi->description;
            $store[$i]['department'] = $kpi->pivot->department_id;
            $i++;
        }
        $collection = collect($store);
        $collection = $collection->sortBy('kpi_id')->groupBy('kpi_name');
        return $collection;
    }
}
