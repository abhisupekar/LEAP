<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as User;
use App\Department as Department;
use App\Submission as Submission;
use Illuminate\Support\Facades\Auth as Auth;
use App\Usersubmissionstatus as Usersubmissionstatus;
use App\Quarter;
use App\Submissionreviewcomment as Submissionreviewcomment;
use App\Mail\Notifications;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()) {
            if (!Usersubmissionstatus::checkQuarterSubmission()) {
              $employee = ['id' => Auth::user()->id];
              if (Usersubmissionstatus::checkDraftSubmission()) {
              $employee['quarter_id'] = Quarter::getRunningQuarter()->id;
              $employee['submission_status_id'] = config('constant.status.SUBMISSION_DRAFT');
                 return view('evaluation-already-submitted', ['draft' => TRUE, 'employee' => $employee]);
                }

                return view('evaluation', ['data' => Department::getDetails(), 'employee_id' => $employee['id']]);
            }
            else {
                return view('evaluation-already-submitted', ['draft' => FALSE]);
            }
        }    
        else {
            return redirect()->guest('login');    
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request, $draft = FALSE)
    {
        if (Auth::user() && $_POST && !Usersubmissionstatus::checkQuarterSubmission()) {
            $submission = [];

            // Let's check the submission already done from save as a draft
            // If it's already done, lets update the status, to avoid duplicate entry
            if (isset($_POST['submission_status_id']) && !empty($_POST['submission_status_id']))  {
             return $this->update($request, $draft);
            }

            $currentQuarter = Quarter::getRunningQuarter()->id;
            foreach($_POST as $key => $value ) {
                if ($key !== '_token' && $key !== 'employee_id' && $key !== 'submission_status_id') {
                    $data = explode('_', $key);
                    $kpi = $data[0];
                    $subkpi = $data[1];
                    $rating = $_POST[$kpi. '_'. $subkpi . '_rating'];
                    $description = $_POST[$kpi. '_'. $subkpi . '_description'];
                    $submission[$subkpi] = array('kpi_id' => $kpi, 'subkpi_id' => $subkpi, 'rating' => $rating, 'description' => $description, 'user_id' => Auth::user()->id, 'quarter_id' => $currentQuarter, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now());
                }
            }
            $result = Submission::insert($submission);

            if ($result) {
                $status = $this->submissionStatus($draft);
                //$request->session()->put('submitted', 1);

              if ($draft) {
                return $result;
              }
            }else {
                if ($draft) {
                return FALSE;
              }
            }

          // Let's notify user and L1 about user submission status.
          $status = $this->sendMail(config('constant.email_status.INFORM_APPRAISEE'));
          return view('evaluation-submission', ['result' => $result, 'email_status' => $status]);
        }
        else {
            return redirect()->guest('login');
        }
    }

    public function update(Request $request, $draft = FALSE)
    {
        if (Auth::user()) {
            $submission = [];

            foreach($_POST as $key => $value ) {
                if ($key !== '_token' && $key !== 'submission_status_id' && $key !== 'submission_review_comment_id' && $key != 'employee_id' && $key != 'review_comment' && $key != 'modified') {
                    $data = explode('_', $key);
                    $kpi = $data[0];
                    $subkpi = $data[1];
                    $rating = $_POST[$kpi. '_'. $subkpi . '_rating'];
                    $description = $_POST[$kpi. '_'. $subkpi . '_description'];
                    $submission[$subkpi] = array('kpi_id' => $kpi, 'subkpi_id' => $subkpi, 'rating' => $rating, 'description' => $description, 'user_id' => Auth::user()->id, 'quarter_id' => Quarter::getRunningQuarter()->id);
                }
            }

            foreach ($submission as $record) {
                $updateStatus = Submission::where('user_id', $request['employee_id'])
                    ->where('quarter_id', $record['quarter_id'])
                    ->where('kpi_id', $record['kpi_id'])
                    ->where('subkpi_id', $record['subkpi_id'])
                    ->update(['rating' => $record['rating'], 'description' => $record['description']]);
            }

            // Checking update is getting done through save as a draft
            if ($draft) {
                return $updateStatus;
            }

            if ($updateStatus) {
                $status = $this->updateSubmissionStatus();
                if (Auth::user()->role_id == 5) {
                    $this->approveSubmissionByHRPost($_POST['submission_review_comment_id'], $_POST['review_comment'], $_POST['modified']);
                }       
            }
            return view('evaluation-submission', ['result' => $updateStatus, 'email_status' => $status]);
        }
        else {
            return redirect()->guest('login');
        }
    }

    public function submissionStatus($draft = FALSE) {

       $status = config('constant.status.L1_APPROVAL_PENDING');

        if ($draft) {
            $status = config('constant.status.SUBMISSION_DRAFT');
        }

        $submissionStatus = ['user_id' => Auth::user()->id, 'quarter_id' => Quarter::getRunningQuarter()->id, 'status_id' => $status];
        Usersubmissionstatus::insert($submissionStatus);
       return $status;
    }

    //update user submission status when appraisee updates submission
    public function updateSubmissionStatus() {

        $updateStatus = Usersubmissionstatus::where('user_id', Auth::user()->id)
                    ->where('quarter_id', Quarter::getRunningQuarter()->id)
                    ->update(['status_id' => config('constant.status.L1_APPROVAL_PENDING')]);
        // Let's notify user and L1 about user submission status.
        return $this->sendMail(config('constant.email_status.INFORM_APPRAISEE'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approveSubmission(Request $request)
    {
        $submission = Usersubmissionstatus::find($request->id);

        // Getting employee id for current submission
        $employeeID = $submission->user_id;
        $submission->status_id = config('constant.status.HR_APPROVAL_PENDING');
        $status = $submission->save();
        $reviewComment = ['submission_status_id' => $request->id, 'reviewer_id' => Auth::user()->id, 'status_id' => config('constant.status.HR_APPROVAL_PENDING'), 'comment' => $request->review_comment, 'created_at' => Carbon::now(), 'updated_at' =>  Carbon::now()];
        if ($status == 1) {
            Submissionreviewcomment::insert($reviewComment);

            // Let's notify user and hr about submission approval
            $status = $this->sendMail(config('constant.email_status.L1_APPROVED'), $employeeID);
            return response()->json(['status' => 1, 'message' => 'Sucessfully Approved', 'email_status' => $status], 200);
        }
        else {
            return response()->json(['status' => 0, 'message' => 'There was an error processing your request, please try again'], 200);   
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rejectSubmission(Request $request)
    {
        $submission = Usersubmissionstatus::find($request->id);

        // Getting employee id for current submission
        $employeeID = $submission->user_id;
        $submission->status_id = config('constant.status.L1_REJECTED');
        $status = $submission->save();
        $reviewComment = ['submission_status_id' => $request->id, 'reviewer_id' => Auth::user()->id, 'status_id' => config('constant.status.L1_REJECTED'), 'comment' => $request->review_comment, 'created_at' => Carbon::now(), 'updated_at' =>  Carbon::now()];
        if ($status == 1) {
            Submissionreviewcomment::insert($reviewComment);

            $status = $this->sendMail(config('constant.email_status.L1_REJECTED'), $employeeID);
            return response()->json(['status' => 1, 'message' => 'Sucessfully Rejected', 'email_status' => $status], 200);
        }
        else {
            return response()->json(['status' => 0, 'message' => 'There was an error processing your request, please try again'], 200);   
        }
    }

    public function approveSubmissionByHRPost($submissionId, $reviewComment, $modified)
    {
        $submission = Usersubmissionstatus::find($submissionId);
        if (!$modified) {
            $newStatus = config('constant.status.HR_APPROVED');
        }
        else {
            $newStatus = config('constant.status.HR_MODIFIED_AND_APPROVED');
        }
        $submission->status_id = $newStatus;
        $status = $submission->save();
        $review = ['submission_status_id' => $submissionId, 'reviewer_id' => Auth::user()->id, 'status_id' => $newStatus, 'comment' => $reviewComment, 'created_at' => Carbon::now(), 'updated_at' =>  Carbon::now()];
        if ($status == 1) {
            Submissionreviewcomment::insert($review);
        }
    }

    public function approveSubmissionByHR(Request $request)
    {
        $submission = Usersubmissionstatus::find($request->id);

        // Getting employee id for current submission
        $employeeID = $submission->user_id;
        $submission->status_id = config('constant.status.HR_APPROVED');
        $status = $submission->save();
        $reviewComment = ['submission_status_id' => $request->id, 'reviewer_id' => Auth::user()->id, 'status_id' => config('constant.status.HR_APPROVED'), 'comment' => $request->review_comment, 'created_at' => Carbon::now(), 'updated_at' =>  Carbon::now()];
        if ($status == 1) {
            Submissionreviewcomment::insert($reviewComment);

            //Let's notify about approval to user
            $status = $this->sendMail(config('constant.email_status.HR_APPROVED'), $employeeID);
            return response()->json(['status' => 1, 'message' => 'Sucessfully Approved', 'email_status' => $status], 200);
        }
        else {
            return response()->json(['status' => 0, 'message' => 'There was an error processing your request, please try again'], 200);   
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Submitting form using ajax call while saving as draft
     *
     * @param  array  $request
     * @return \Illuminate\Http\Response
     */
    public function submissionAsDraft(Request $request)
    {

     if ($_POST) {
        $result['submission_status_id'] = config('constant.status.SUBMISSION_DRAFT');
        if (isset($_POST['submission_status_id']) && $_POST['submission_status_id'] == $result['submission_status_id']) {
            $result['status'] = $this->update($request, TRUE);
        }else {
            $result['status'] = $this->save($request, TRUE);
        }
        return response()->json($result, 200);
      }
    }


  /**
   * Helper function to set params for mail
   * @param string $action
   */
    private function sendMail($action = NULL, $employeeID = NULL, $notifyManager = NULL)
    {
        $mailDetails = ['action' => $action, 'manager' => User::getEmployeeManager()];

        if ($employeeID) {
          $user = User::find($employeeID);
        }
        else {
          $user = Auth::user();
        }

        $mailDetails['user'] = (object) ['first_name' => $user->first_name, 'last_name' => $user->last_name, 'email' => $user->email];

        $email = $mailDetails['user']->email;
        if ($notifyManager) {
          $email = $mailDetails['manager']->email;
        }

        if ($action == config('constant.email_status.INFORM_HR')) {
          $email = config('constant.hr_email');
        }

        try {
          Mail::to($email)->send(new Notifications($mailDetails));
        }
        catch (\Exception $e) {
          return false;
        }

        $managerStatus = NULL;
        switch ($action) {
          case config('constant.email_status.INFORM_APPRAISEE'):
            $managerStatus = config('constant.email_status.INFORM_APPRAISER');
            break;

          case config('constant.email_status.L1_APPROVED'):
            $managerStatus = config('constant.email_status.INFORM_HR');
          break;
        }

        if ($managerStatus) {
            $this->sendMail($managerStatus, $employeeID, true);
        }

        return true;
    }
}