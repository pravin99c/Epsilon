<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use App\Mail\ForgotPasswordSendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendPasswordResetEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public $url;
    public $email;
    public $data;

    public function __construct($url, $email, $data = null)
    {
        $this->url = $url;
        $this->email = $email;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Mail for forgot password reset email will be sent to the user
            Mail::to($this->email)->send(new ForgotPasswordSendMail($this->url,  $this->data));
        } catch (\Exception $e) {
            Log::error('SendPasswordResetEmail job failed: '.$e->getMessage());
        }
    }
}
