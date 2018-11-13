<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
	protected $table = 'user_submission_status';

    public function status()
    {
        return $this->hasMany('App\Models\User');
    }

    public static function getManagerEmpAndStatus(){
        $store = [];
        $employeeIds = User::getManagerEmpIds();
        foreach($employeeIds as $employee) {
            //echo $employee;
            echo '<pre>';
            foreach(SELF::find($employee)->status as $empData) {
                print_r($empData);
            }
        }
    }
}
