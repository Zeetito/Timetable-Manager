<?php

use App\Models\Room;
use App\Models\User;
use App\Models\Course;
use App\Models\Program;
use App\Models\ClassGroup;
use App\Models\CourseUser;
use App\Models\Department;
use App\Models\ProgramStream;
use App\Models\CourseSchedule;
use App\Jobs\UserNotificationJob;
use App\Models\ClassGroupDivision;
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

    return ClassGroupDivision::all();
    
    return User::find(1)->class_code;
    return User::find(1)->class_group->is_divided;

    return Course::find(44)->class_groups_of_stream('regular')->first();
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

   

    return $days;

    return Course::find(45)->isYetToBeScheduledForStream('regular');
    return User::find(8933)->registered_core_courses;
    return ClassGroup::find(280)->users;

    $classgroups_id =   ClassGroup::whereHas('courses', function($q){
        $q->where('is_elective', 1);
    })->get()->pluck('id')->toArray();

    return $classgroups_id;
    $randomKeys = array_rand($classgroups_id, 2);

    foreach($randomKeys as $key){
        echo "hey". $classgroups_id[$key] . "  \n";
    }
    return 0;

    $randomElements = [$classgroups_id[$randomKeys[0]], $classgroups_id[$randomKeys[1]]];

    return $randomElements;

    return ClassGroup::find(6463)->elective_courses;
    // return ClassGroup::ug_classgroups()->count();
    return ClassGroup::classgroups_with_less_than(10);
    return ClassGroup::pg_classgroups()->take(5);
    return ProgramStream::ug_streams();
    return Program::find(4)->program_streams->first()->graduate_type;
    return ClassGroup::pg_classgroups()->count();
    // return Department::find(56)->
    

});
