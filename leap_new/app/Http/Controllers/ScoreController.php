<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use App\Models\User;
use App\Submission;
use App\KpiSubkpiDepartment;
use DB;
use App\Quarter;
use App\Department;
use App\Subkpi;
use Carbon\Carbon;

class ScoreController extends Controller
{

    private static $percentage = [
                         0 =>['min' => 0, 'max' => 64],
                         50 =>['min' => 65, 'max' => 74],
                         75 =>['min' => 75, 'max' => 85],
                         100 =>['min' => 85, 'max' => 100]
                       ];

    public function scoreTriggerPreprocess()
    {   //$quarter = Quarter::getRunningQuarter();
        $quarters = Quarter::all();
        $years = DB::table('submissions')
                ->select(DB::raw('YEAR(created_at) as year'))
                ->distinct()
                ->orderBy('year', 'desc')
                ->get();
        //dd($years);
        return view('reports.report-generation', ['quarters' => $quarters, 'years' => $years]);
    }

    public function scoreTrigger(Request $request)
    {   print_r($request->all());
        //exit;
        if (Auth::user()) {
            $reportCreationStatus = DB::table('reporting_status')
                ->where('quarter_id', '=', $request->quarter)
                ->where('created_at', 'like', '%' . $request->year .'%')
                ->get();
           // dd($reportCreationStatus);
            if(empty($reportCreationStatus->status)) {
                $users_count = DB::table('users')
                ->where('status', '=', 1)
                ->where('role_id', '<=', 3)
                ->get()
                ->count();
                print($users_count);
                //exit;
                $submissions = DB::table('users')
                ->join('user_submission_status', 'users.id', '=', 'user_submission_status.user_id')
                ->where('user_submission_status.quarter_id', '=', $request->quarter)
                ->where('user_submission_status.created_at', 'like', '%' . $request->year .'%')
                ->where('users.role_id', '<=', 3)
                ->where('users.status', '=', 1)
                ->whereIn('user_submission_status.status_id', [config('constant.status.HR_APPROVAL_PENDING'),config('constant.status.HR_APPROVED'),config('constant.status.HR_MODIFIED_AND_APPROVED')])
                ->get()
                ->count();
                
                print($submissions);
                $diff = $users_count-$submissions;
                return view('reports.report-generation-status', ['diff' => $diff, 'quarterDetails' => $quarterDetails]);
            }
        }
        return redirect()->guest('login');
    }

    public function index()
    {
        $quarter = Quarter::getRunningQuarter();
            
        if (Auth::user()) {
            $userSubmission = DB::table('submissions')
                ->leftJoin('users', 'submissions.user_id', '=', 'users.id')
                ->leftJoin('subkpis', 'submissions.subkpi_id', '=', 'subkpis.id')
                ->leftJoin('user_submission_status', 'submissions.user_id', '=', 'user_submission_status.user_id')
                ->whereIn('user_submission_status.status_id', [config('constant.status.HR_APPROVAL_PENDING'),config('constant.status.HR_APPROVED'),config('constant.status.HR_MODIFIED_AND_APPROVED')])
                ->where('submissions.quarter_id', '=', $quarter->id)
                ->groupBy('subkpis.id', 'users.id')
                ->select('submissions.user_id AS user_id', 'submissions.kpi_id AS kpi_id', 'submissions.subkpi_id AS subkpi_id', 'submissions.quarter_id AS quarter_id', 'users.department_id AS department_id', 'users.role_id AS role_id', 'submissions.rating AS rating', 'subkpis.is_positive AS is_positive')
                ->get();

            $this->storeSubkpiSubmission($userSubmission);
        }
    }

    /* Storing subkpi submission score into database */
    public function storeSubkpiSubmission($userSubmission){
        //dd($userSubmission);
        foreach ($userSubmission as $subkpiSubmission) {
            $scoringRequiredData = $this->getWeightProfeciencyLevel($subkpiSubmission);
            if(!empty($scoringRequiredData[0])){
                // Let's check for subkpi which having PL in percentage
                $isSubkpiPercent = FALSE;
                if (in_array($subkpiSubmission->subkpi_id, config('constant.subkpid_pl_percent'))) {
                    $isSubkpiPercent = TRUE;
                }
                $subkpiScore = $this->scoreCalculate($scoringRequiredData, $subkpiSubmission->rating, $subkpiSubmission->is_positive, $isSubkpiPercent);
                $userScoring = [];
                $userScoring['user_id'] = $subkpiSubmission->user_id;
                $userScoring['role_id'] = $subkpiSubmission->role_id;
                $userScoring['kpi_id'] = $subkpiSubmission->kpi_id;
                $userScoring['subkpi_id'] = $subkpiSubmission->subkpi_id;
                $userScoring['department_id'] = $subkpiSubmission->department_id;
                $userScoring['score'] = $subkpiScore;
                $userScoring['quarter_id'] = $subkpiSubmission->quarter_id;
                $userScoring['created_at'] = Carbon::now();
                DB::table('user_scoring')->insert($userScoring);
            }
        }
    }
    
    /* Fetch weight and Profeciency Level of subkpi for score calculation */
    private function getWeightProfeciencyLevel($subkpiSubmission)
    {   
        $ksd_id = KpiSubkpiDepartment::select('id')
                                    ->where('kpi_id', $subkpiSubmission->kpi_id)
                                    ->where('subkpi_id', $subkpiSubmission->subkpi_id)
                                    ->where('department_id', $subkpiSubmission->department_id)
                                    ->first();

        $scoringRequiredData =  DB::table('weight_distribution')
            ->select('weight', 'proficiency_level')
            ->where('ksd_id', $ksd_id->id)
            ->where('role_id', $subkpiSubmission->role_id)
            ->get();

        return $scoringRequiredData;
    }

    /* Calculating score */
    private function scoreCalculate($scoringRequiredData, $rating, $isPositive, $isSubkpiPercent = FALSE)
    {
        switch ($isPositive) {

            //Negative KPIs will be calculated here
            /* Formula: (ProfeciencyLevel/2^rating)*weight */
            case '0':
            if($scoringRequiredData[0]->proficiency_level == 0) {
                $subkpiScore = $scoringRequiredData[0]->weight;
            }
            else {
                $subkpiScore = (($scoringRequiredData[0]->proficiency_level )/2**$rating)*($scoringRequiredData[0]->weight);
                if ($subkpiScore >= $scoringRequiredData[0]->weight * 2) {
                    $subkpiScore = $scoringRequiredData[0]->weight * 2;
               }
            }
            break;

            /*Formula: (rating/ProfeciencyLevel)*weight */
            case '1':
            if($scoringRequiredData[0]->proficiency_level == 0) {
                $subkpiScore = $scoringRequiredData[0]->weight;
                //Positive KPIs will be calculated here
                if ($isSubkpiPercent ) {
                    foreach (SELF::$percentage as $key => $value) {
                        if ($rating >= $value['min'] && $rating <= $value['max']) {
                          $subkpiScore = ($key * $scoringRequiredData[0]->weight)/100;
                          break;
                        }
                    }
                }
            }
            else {
                 $subkpiScore = (($rating)/($scoringRequiredData[0]->proficiency_level))*($scoringRequiredData[0]->weight);
             if ($subkpiScore >= $scoringRequiredData[0]->weight * 2) {
                    $subkpiScore = $scoringRequiredData[0]->weight * 2;
               }
             }
            break;
           }
        return $subkpiScore;
    }
}