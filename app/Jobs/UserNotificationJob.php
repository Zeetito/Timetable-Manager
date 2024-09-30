<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UserNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $message;
    public $url;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param string $message
     * @param string $url
     */
    public function __construct(User $user, $message, $url)
    {
        $this->user = $user;
        $this->message = $message;
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Send the notification to the user
        $this->user->notify(new UserNotification($this->message, $this->url));
    }
}
