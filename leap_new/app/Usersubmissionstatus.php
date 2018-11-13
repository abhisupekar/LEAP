<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth as Auth;
use App\Quarter;

class Usersubmissionstatus extends Model
{
	protected $table = 'user_submission_status';

    public function users()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public static function checkQuarterSubmission() {
    	$submission = SELF::where('user_submission_status.user_id', Auth::user()->id)
    				  	->where('user_submission_status.quarter_id', Quarter::getRunningQuarter()->id)
                        ->where('user_submission_status.status_id', "!=", config('constant.status.SUBMISSION_DRAFT'))
    					->pluck('id');
        if (count($submission) > 0) {
            return true;
        }
        return false;
    }
    
     public static function checkDraftSubmission() {
        $submission = SELF::where('user_submission_status.user_id', Auth::user()->id)
                        ->where('user_submission_status.quarter_id', Quarter::getRunningQuarter()->id)
                        ->where('user_submission_status.status_id', "=", config('constant.status.SUBMISSION_DRAFT'))
                        ->pluck('id');
        if (count($submission) > 0) {
            return true;
        }
        return false;
    }
}
