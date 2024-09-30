<?php

use App\Models\User;
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
    $user = User::find(93502);
    return $user->notifications->first()->markAsRead();
    $message = "Hello Second Testing Job";
    $url = route('baba');
    UserNotificationJob::dispatch($user, $message, $url);
    return "vhim";
    // return App\Models\User::find(1)->semester_id;
    // return App\Models\User::students()->get()->take(20);
    // return App\Models\User::paginate(50);
    
    return App\Models\Program::find(2)->students;
    return App\Models\User::all();


    // return App\Models\User::find(20)->course();
    return App\Models\ClassGroup::regular_classgroups();
    return App\Models\ProgramStream::find(1)->users();
    return App\Models\ClassGroupCourse::all();


});
