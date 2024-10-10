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
    return 'welcome to Baba route';
})->name('baba');

Route::get('/hello', function () {
    ini_set('max_execution_time', '120');
    return Course::courses_to_be_scheduled_for_stream('regular')->pluck('id');
    return Course::find(3)->isScheduledForStream('regular');
    return CourseSchedule::course_schedules_for_stream('regular');
});
