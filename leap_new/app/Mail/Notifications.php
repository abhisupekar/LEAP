<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Notifications extends Mailable
{
    use Queueable, SerializesModels;

     /**
     * The mail Details.
     *
     * @var mail
     */
    private $mailDetails = array();

     /**
     * The template file to use.
     *
     * @var Template
     */
    private $template = 'emails.notify';

    /**
     * The subject for mail.
     *
     * @var Template
     */
    public $subject = 'Leap Notification';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details = array())
    {
        $this->mailDetails = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        switch ($this->mailDetails['action']) {
            case config('constant.email_status.INFORM_APPRAISEE'):
                $this->template = 'emails.users.inform-appraisee';
                $this->subject = 'Submission L1 Approval Pending';
                break;

            case config('constant.email_status.INFORM_APPRAISER'):
                $this->template = 'emails.manager.inform-appraiser';
                $this->subject = 'Submission By Appraisee';
                break;
            
            case config('constant.email_status.L1_APPROVED'):
                $this->template = 'emails.users.l1-approved';
                $this->subject = 'Submission Approved By L1';
                break;

            case config('constant.email_status.L1_REJECTED'):
                $this->template = 'emails.users.l1-rejected';
                $this->subject = 'Submission Rejected By L1';
                break;

            case config('constant.email_status.INFORM_HR'):
                $this->template = 'emails.hr.inform-hr';
                $this->subject = 'Submission Approved By L1';
                break;

             case config('constant.email_status.HR_APPROVED'):
                $this->template = 'emails.user.hr-approved';
                $this->subject = 'Submission Approved By HR';
                break;
        }
        return $this->markdown($this->template, ['details' => $this->mailDetails]);
    }
}
