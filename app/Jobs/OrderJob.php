<?php

namespace App\Jobs;

use App\Models\Configuration;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class OrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Order $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
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
            Notification::send($user, new OrderNotification($this->order));
        }
    }
}
