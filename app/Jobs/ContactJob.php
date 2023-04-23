<?php

namespace App\Jobs;

use App\Models\Configuration;
use App\Models\Contact;
use App\Models\User;
use App\Notifications\ContactNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class ContactJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Contact $contact;

    /**
     * Create a new job instance.
     *
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $user = new User();
        $mailList = preg_split('/[;,]/', Configuration::whereName('email')->firstOrFail()->content);
        for ($i = 0; $i < count($mailList); $i++) {
            if (empty(trim($mailList[$i]))) {
                continue;
            }
            $user->email = trim($mailList[$i]);
            Notification::send($user, new ContactNotification($this->contact));
        }
    }
}
