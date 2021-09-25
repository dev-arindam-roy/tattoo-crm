<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class MailSendJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $templateName;
    public $subject;
    public $emailTo;
    public $data;

    public function __construct($templateName, $subject, $emailTo, $data)
    {
        $this->templateName = $templateName;
        $this->subject = $subject;
        $this->emailTo = $emailTo;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emailData = array();
        $emailData['body'] = $this->data;
        Mail::send($this->templateName, ['emailData' => $emailData], function ($message) use ($emailData) {

            $message->to($this->emailTo)->subject($this->subject);
        });
    }
}
