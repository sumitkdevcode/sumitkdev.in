<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendBulkMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $emails;
    public $template;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $emails, \App\Models\EmailTemplate $template)
    {
        $this->emails = $emails;
        $this->template = $template;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->emails as $email) {
            $email = trim($email);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                continue;
            }

            // Extract a rudimentary name from the email (e.g., john.doe@... -> John Doe)
            $namePart = explode('@', $email)[0];
            $name = ucwords(str_replace(['.', '_', '-'], ' ', $namePart));

            // Replace {{ name }} placeholder in the body
            $personalizedBody = str_replace('{{ name }}', $name, $this->template->body);

            try {
                \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\DynamicEmail($this->template->subject, $personalizedBody));
                
                // Sleep for a tiny bit to avoid hitting rate limits on some SMTP providers
                usleep(200000); // 200ms
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error("Failed to send bulk email to {$email}: " . $e->getMessage());
            }
        }
    }
}
