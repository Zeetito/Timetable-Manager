<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\Api\V1\CourseScheduleController;

class CourseScheduleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $courseIds;
    public $stream;

    /**
     * Create a new job instance.
     * @param array $courseIds
     * @param string $stream
     */
    public function __construct(array $courseIds, string $stream)
    {
        $this->courseIds = $courseIds;  // List of course IDs
        $this->stream = $stream;        // Stream name
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Call the scheduling function in the CourseScheduleController
        $courseScheduleController = new CourseScheduleController();
        $courseScheduleController->scheduleCoursesForStream($this->courseIds, $this->stream);
    }
}
