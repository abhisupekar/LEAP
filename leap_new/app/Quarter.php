<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB as DB;

class Quarter extends Model
{
    public static function getRunningQuarter() {
    	$dm = Carbon::now()->format('md');
    	$january = SELF::handleJanuary($dm);
    	if ($january) {
    		$dm = substr_replace($dm, '13', 0, 2);
    	}
    	$quarter = DB::table('quarters')
                    ->where('start_date', '<=', $dm)
                    ->where('end_date', '>=', $dm)
                    ->first();
        return $quarter;
    }

    public static function handleJanuary($dm) {
    	if ($dm >= '0101' && $dm <= '0131')  {
    		return true;
    	}
    	return false;
    }
}
