<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Http\Request;
use \App\UserScoring as UserScore;
use \App\Quarter as Quarter;
use Carbon\Carbon;
use PDF;

class ReportController extends Controller
{

    /**
     * @variables to store individual score.
     */
    private static $currentQuarter = NULL;

    private static $score = array();

    private static $subkpiScore = array();

    private static $highestSubkpiScore = array();

    private static $peerGroups = array();

    private static $weightages = array();

    private static $kpiScore = array();

    private static $HighestKpiScore = array();

    private static $totalScore = array();

    public function index()
    {
        if (Auth::user()) {

        SELF::$currentQuarter = Quarter::getRunningQuarter();
        $m_d_start = str_split(SELF::$currentQuarter->start_date, 2);
        $m_d_end = str_split(SELF::$currentQuarter->end_date, 2);
        if ($m_d_end[0] == 13) {
          $m_d_end[0] = 01;
        }
        $year = SELF::$currentQuarter->year = Carbon::now()->year;
        SELF::$currentQuarter->start_date = date('jS M', strtotime("{$year}-{$m_d_start[0]}-{$m_d_start[1]}"));
        SELF::$currentQuarter->end_date = date('jS M', strtotime("{$year}-{$m_d_end[0]}-{$m_d_end[1]}"));


        SELF::$weightages = SELF::getPeerWeightages();

        $users = UserScore::getUsersScore();

        foreach ($users as $user) {

            // Manage data for user
            SELF::generateReportData($user);
          }

            // Generate report for users
            SELF::generateReport();
        }
        return redirect()->guest('login');
    }

    /**
     * Helper function to arrange data for report generation
     */
    private static function generateReportData($user)
    {
        SELF::$score[$user->user_id] = $user;
        SELF::$peerGroups[$user->department_id][$user->role_id][$user->user_id] = $user->first_name.' '.$user->last_name;
        SELF::$subkpiScore[$user->department_id][$user->role_id][$user->user_id][$user->kpi][$user->subkpi_id] = array('name' => $user->subkpi, 'weight' => $user->score);

        // Let's calculate highest subkpi score for individual subkpis
        SELF::getHighestSubkpiScore($user);

        // Let's calculate highest kpi score for individual subkpis
        SELF::getKpiScore($user);

        // Let's calcutate total score for user
        SELF::getTotalScore($user);

        // Get highest kpi score for user
        SELF::getHighestKpiScore($user->department_id, $user->role_id, $user->kpi_id, $user->kpi);
    }

    /**
     * Generate report data
     */
    private static function generateReport()
    {
        foreach (SELF::$score as $user) {

            $data = SELF::buildData($user);
            $data['quarter'] = SELF::$currentQuarter;
            $fileName = "{$user->first_name}{$user->last_name}_{$user->employee_code}_".$data['quarter']->name."_{$user->department_name}_".date('Y');

            $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            $pdf->loadView('reports.quarter-report', $data)->save(public_path()."/files/reports/{$fileName}.pdf");
        }
    }

    /**
     * Build PDF data for user
     */
    private static function buildData ($user) {
        $data['user'] = (array) $user;
        $data['peer_groups'] = implode(', ', SELF::$peerGroups[$user->department_id][$user->role_id]);
        $data['weightages'] = SELF::$weightages[$user->department_id];
        $data['subkpi_score'] = SELF::$subkpiScore[$user->department_id][$user->role_id][$user->user_id];
        $data['highest_subkpi_score'] = SELF::$highestSubkpiScore[$user->department_id][$user->role_id];
        $data['kpi_score'] = SELF::$kpiScore[$user->department_id][$user->role_id][$user->user_id];
        $data['highest_kpi_score'] = SELF::$HighestKpiScore[$user->department_id][$user->role_id];
        $data['total_score'] = SELF::$totalScore[$user->department_id][$user->role_id][$user->user_id];
        $data['highest_total_score'] = max(SELF::$totalScore[$user->department_id][$user->role_id]);
        return $data;
    }

    /**
     * Get highest score for subkpis among peer
     */
    private static function getHighestSubkpiScore($user)
    {
     if (!isset(SELF::$highestSubkpiScore[$user->department_id][$user->role_id][$user->kpi][$user->subkpi])) {
       $highScore = $user->score;
     }else {
        $highScore = SELF::$highestSubkpiScore[$user->department_id][$user->role_id][$user->kpi][$user->subkpi];
     }

    if ($highScore < $user->score) {
        $highScore = $user->score;
    }

    SELF::$highestSubkpiScore[$user->department_id][$user->role_id][$user->kpi][$user->subkpi] = $highScore;
    }

    /**
     * calculateKpiScore
     */
    private static function getKpiScore($user)
    {
        $score = $user->score;
        if (!isset(SELF::$kpiScore[$user->department_id][$user->role_id][$user->user_id][$user->kpi]))
        {
            SELF::$kpiScore[$user->department_id][$user->role_id][$user->user_id][$user->kpi] = 0.00;
        }

        SELF::$kpiScore[$user->department_id][$user->role_id][$user->user_id][$user->kpi] += $score;

    }

    /**
     * Calculate highest kpi score
     */
    private static function getHighestKpiScore($departmentId, $roleId, $kpiID, $kpi) {

    if (!isset(SELF::$HighestKpiScore[$departmentId][$roleId][$kpi])) {
    SELF::$HighestKpiScore[$departmentId][$roleId][$kpi] = UserScore::getHighestScore($departmentId, $roleId, $kpiID)->highest;
     }
    }


    /**
     * calculate total score for user
     */
    private static function getTotalScore($user)
    {
        if (!isset(SELF::$totalScore[$user->department_id][$user->role_id][$user->user_id])) {
            SELF::$totalScore[$user->department_id][$user->role_id][$user->user_id] = 0.00;
         }
         SELF::$totalScore[$user->department_id][$user->role_id][$user->user_id] += $user->score;
    }


    /**
     * Get weightages for reference
     */
    private static function getPeerWeightages()
    {
            $results = [];
            $weightages = DB::table('weight_distribution')
                            ->leftjoin('kpi_subkpis_department', 'kpi_subkpis_department.id', '=', 'weight_distribution.ksd_id')
                            ->leftjoin('kpis', 'kpis.id', '=', 'kpi_subkpis_department.kpi_id')
                            ->leftjoin('roles', 'roles.id', '=', 'weight_distribution.role_id')
                            ->select('kpis.name as kpi', 'roles.name as role', 'kpi_subkpis_department.department_id as department_id', DB::raw('SUM(weight_distribution.weight) as weight'))
                            ->groupBy('kpis.id', 'roles.id', 'kpi_subkpis_department.department_id')
                            ->get()->toArray();
            foreach ($weightages as $key => $value) {
                $results[$value->department_id]['roles'][$value->role] = $value->role;
                $results[$value->department_id]['weightages'][$value->kpi][$value->role] = $value->weight;
            }
            return $results;
    }

    /**
     * Fetch Quarter report for users.
     */
   public function fetchReport(Request $request) {
    $user = Auth::user();
    if ($user) {
        $data = $request->all();
        $file_name = "{$user->first_name}{$user->last_name}_{$user->employee_code}_{$data['quarter']}_{$data['department']}_{$data['year']}";
        header("Content-type: application/pdf");
        header("Content-disposition: attachment;filename=".basename(public_path()."/files/reports/{$file_name}.pdf"));
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        readfile(public_path()."/files/reports/{$file_name}.pdf");
       }
       else {
         return redirect()->guest('login');
        }
     }
}