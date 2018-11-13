<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\DB as DB;

class Submission extends Model
{
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    Public function kpis()
    {
    	return $this->belongsTo('App\Kpi');	
    }

    Public function subkpis()
    {
    	return $this->belongsTo('App\Subkpi');	
    }

    public static function fetchSubmission($userId, $quarterId) {
    	$submission = DB::table('submissions')
    		->leftjoin('kpis', 'submissions.kpi_id', '=', 'kpis.id')
    		->leftjoin('subkpis', 'submissions.subkpi_id', '=', 'subkpis.id')
            ->leftJoin('user_submission_status', function($join)
                {
                    $join->on('submissions.user_id', '=', 'user_submission_status.user_id');
                    $join->on('submissions.quarter_id','=', 'user_submission_status.quarter_id');
                })
            ->leftjoin('status', 'user_submission_status.status_id', '=', 'status.id') 
            ->where('submissions.user_id', '=', $userId)
            ->where('user_submission_status.quarter_id', '=', $quarterId)
            ->get(['submissions.*','kpis.name AS kpi_name', 'subkpis.name AS subkpi_name', 'subkpis.description AS subkpi_description','subkpis.min AS subkpi_min_val', 'subkpis.max AS subkpi_max_val', 'user_submission_status.id AS status_id', 'status.name AS submission_status']);
        $collection = collect($submission);
        $collection = $collection->groupBy('kpi_name');
        return $collection;
    }
}
