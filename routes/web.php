<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/hello', function () {
    // return App\Models\User::find(1)->semester_id;
    // return App\Models\User::students()->get()->take(20);

    return App\Models\User::find(5720)->program;
    return App\Models\User::where('id','>',63840)->count();
    return App\Models\User::find(63841)->registered_courses->count();
    return App\Models\ClassGroupCourse::all();
});
