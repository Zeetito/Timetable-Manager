<?php

use App\Models\User;
use App\Models\Course;
use App\Models\ClassGroup;
use App\Models\CourseUser;
use App\Models\Department;
use App\Models\CourseSchedule;
use App\Jobs\UserNotificationJob;
use Illuminate\Support\Facades\Route;
use App\Notifications\UserNotification;
use App\Http\Controllers\Api\V1\CourseScheduleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
});

Route::get('/baba', function () {
    return CourseScheduleController::dispatchCourseScheduleJobForStream('regular');
})->name('baba');

Route::get('/hello', function () {
    // return ClassGroup::find(18)->course_schedules;
    return CourseSchedule::all();
    ini_set('max_execution_time', '120');
    return Course::courses_to_be_scheduled_for_stream('regular')->pluck('id');
    return Course::find(3)->isScheduledForStream('regular');
    return CourseSchedule::course_schedules_for_stream('regular');
});
