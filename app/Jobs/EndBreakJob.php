<?php

namespace App\Jobs;

use App\Mail\EndBreakEmail;
use App\Notifications\BreakNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EndBreakJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $break;
    protected $user;

    public function __construct($break, $user)
    {
        $this->break = $break;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // dd($this->userName, $this->attendance);
        Mail::to(['admin@kleinbott.com', 'zaeem@kleinbott.com'])->send(
            new EndBreakEmail($this->user, $this->break)
        );
    }
}
