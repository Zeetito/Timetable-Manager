<?php

use App\Models\Role;
use App\Models\Room;
use App\Models\User;
use App\Models\Course;
use App\Models\College;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\ClassGroup;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\ProgramStream;
use App\Models\ClassGroupDivision;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\RoomController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\CourseController;
use App\Http\Controllers\Api\V1\CollegeController;
use App\Http\Controllers\Api\V1\FacultyController;
use App\Http\Controllers\Api\V1\ProgramController;
use App\Http\Controllers\Api\V1\RoleUserController;
use App\Http\Controllers\Api\V1\ScheduleController;
use App\Http\Controllers\Api\V1\SemesterController;
use App\Http\Controllers\Api\V1\ClassGroupController;
use App\Http\Controllers\Api\V1\CourseUserController;
use App\Http\Controllers\Api\V1\DepartmentController;
use App\Http\Controllers\Api\V1\AcademicYearController;
use App\Http\Controllers\Api\V1\SemesterUserController;
use App\Http\Controllers\Api\V1\ProgramStreamController;
use App\Http\Controllers\Api\V1\SemesterEventController;
use App\Http\Controllers\Api\V1\CourseScheduleController;
use App\Http\Controllers\Api\V1\ClassGroupCourseController;
use App\Http\Controllers\Api\V1\ClassGroupDivisionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/hello', function (Request $request) {
    return $request->user();
});

// AUTH
    // Login 
    Route::post('/login', [AuthController::class, 'login']);
    // Logout 
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// 1-ACADEMIC YEAR
    // Show
    Route::get('/academic_years/{academic_year}', [AcademicYearController::class, 'show'])
    ->middleware('auth:sanctum')
    ;

    // Index
    Route::get('/academic_years', [AcademicYearController::class, 'index'])
    ->middleware('auth:sanctum')
    ;

    // Store
    Route::post('/academic_years', [AcademicYearController::class, 'store'])
    ->middleware('auth:sanctum')
    ;

    // Update
    Route::put('/academic_years/{academic_year}', [AcademicYearController::class, 'update'])
    ->middleware('auth:sanctum')
    ;

    // Destroy
    Route::delete('/academic_years/{academic_year}', [AcademicYearController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;

// 2-SEMESTER
    // Show
    Route::get('/semesters/{semester}', [SemesterController::class, 'show'])
    ->middleware('auth:sanctum')
    ;

    // Index
    Route::get('/semesters', [SemesterController::class, 'index'])
    ->middleware('auth:sanctum')
    ;

    // Store
    Route::post('/semesters', [SemesterController::class, 'store'])
    ->middleware('auth:sanctum')
    ;

    // Update
    Route::put('/semesters/{semester}', [SemesterController::class, 'update'])
    ->middleware('auth:sanctum')
    ;

    // Delete
    Route::delete('/semesters/{semester}', [SemesterController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;

// 3-COLLEGES
    // Show
    Route::get('/colleges/{college}', [CollegeController::class, 'show'])
    ->middleware('auth:sanctum')
    ;

    // Index
    Route::get('/colleges', [CollegeController::class, 'index'])
    ->middleware('auth:sanctum')
    ;

    // Store 
    Route::post('/colleges', [CollegeController::class, 'store'])
    ->middleware('auth:sanctum')
    ;

    // Update
    Route::put('/colleges/{college}', [CollegeController::class, 'update'])
    ->middleware('auth:sanctum')
    ;

    // Delete
    Route::delete('/colleges/{college}', [CollegeController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;

    // USERS
    // Get Users for the college
    Route::middleware('auth:sanctum')->get('/colleges/{college}/users', function (Request $request, College $college) {
        return response()->json($college->users());
    });

    // Get Students
    Route::middleware('auth:sanctum')->get('/colleges/{college}/students', function (Request $request, College $college) {
        return response()->json($college->students());
    });

    // PostGraduate Students
    Route::middleware('auth:sanctum')->get('/colleges/{college}/students/postgraduate', function (Request $request, College $college) {
        return response()->json($college->pg_students());
    });

    // underGraduate Students
    Route::middleware('auth:sanctum')->get('/colleges/{college}/students/undergraduate', function (Request $request, College $college) {
        return response()->json($college->ug_students());
    });


    // Get Staff
    // Route::middleware('auth:sanctum')->get('/colleges/{college}/staff', function (Request $request, College $college) {
    //     return response()->json($college->staff());
    // });


    // COURSES
    Route::middleware('auth:sanctum')->get('/colleges/{college}/courses', function (Request $request, College $college) {
        return response()->json($college->courses());
    });

    // idlCourses
    Route::middleware('auth:sanctum')->get('/colleges/{college}/courses/idl', function (Request $request, College $college) {
        return response()->json($college->idl_courses());
    });

    // regularCourses
    Route::middleware('auth:sanctum')->get('/colleges/{college}/courses/regular', function (Request $request, College $college) {
        return response()->json($college->regular_courses());
    });


    // FACULTIES
    // Index
    Route::middleware('auth:sanctum')->get('/colleges/{college}/faculties', function (Request $request, College $college) {
        return response()->json($college->factulies);
    });

    // PROGRAMS
    // index
    Route::middleware('auth:sanctum')->get('/colleges/{college}/programs', function (Request $request, College $college) {
        return response()->json($college->programs);
    });

    // Postgraduate Programs
    Route::middleware('auth:sanctum')->get('/colleges/{college}/programs/postgraduate', function (Request $request, College $college) {
        return response()->json($college->pg_programs());
    });

    // Undergraduate Programs
    Route::middleware('auth:sanctum')->get('/colleges/{college}/programs/undergraduate', function (Request $request, College $college) {
        return response()->json($college->ug_programs());
    });

    // idl programs
    Route::middleware('auth:sanctum')->get('/colleges/{college}/programs/idl', function (Request $request, College $college) {
        return response()->json($college->idl_programs());
    });

    // Regular Programs
    Route::middleware('auth:sanctum')->get('/colleges/{college}/programs/regular', function (Request $request, College $college) {
        return response()->json($college->regular_programs());
    });

    // DEPARTMENTS
    // index
    Route::middleware('auth:sanctum')->get('/colleges/{college}/departments', function (Request $request, College $college) {
        return response()->json($college->departments);
    });

// 4- FACULTY
    // Show
    Route::get('/faculties/{faculty}', [FacultyController::class, 'show'])
    ->middleware('auth:sanctum')
    ;

    // Index
    Route::get('/faculties', [FacultyController::class, 'index'])
    ->middleware('auth:sanctum')
    ;

    // Store
    Route::post('/faculties', [FacultyController::class, 'store'])
    ->middleware('auth:sanctum')
    ;

    // Update
    Route::put('/faculties/{faculty}', [FacultyController::class, 'update'])
    ->middleware('auth:sanctum')
    ;

    // Delete
    Route::delete('/faculties/{faculty}', [FacultyController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;

    // USERS
    // Get students of the faculty
    Route::middleware('auth:sanctum')->get('/faculties/{faculty}/students', function (Request $request, Faculty $faculty) {
        return response()->json($faculty->students());
    });

    // Get postgraduate students of the faculty
    Route::middleware('auth:sanctum')->get('/faculties/{faculty}/students/postgraduate', function (Request $request, Faculty $faculty) {
        return response()->json($faculty->pg_students());
    });

    // Get undergraduage students of the faculty
    Route::middleware('auth:sanctum')->get('/faculties/{faculty}/students/undergraduate', function (Request $request, Faculty $faculty) {
        return response()->json($faculty->ug_students());
    });

    // DEPARTMENTS
    // index
    Route::middleware('auth:sanctum')->get('/faculties/{faculty}/departments', function (Request $request, Faculty $faculty) {
        return response()->json($faculty->departments);
    });

    // PROGRAMS
    // index
    Route::middleware('auth:sanctum')->get('/faculties/{faculty}/programs', function (Request $request, Faculty $faculty) {
        return response()->json($faculty->programs);
    });

    // Postgraduate Programs
    Route::middleware('auth:sanctum')->get('/faculties/{faculty}/programs/postgraduate', function (Request $request, Faculty $faculty) {
        return response()->json($faculty->pg_programs());
    });

    // Undergraduate Programs
    Route::middleware('auth:sanctum')->get('/faculties/{faculty}/programs/undergraduate', function (Request $request, Faculty $faculty) {
        return response()->json($faculty->ug_programs());
    });

// 5-DEPARTMENT
    // Show
    Route::middleware('auth:sanctum')->get('/departments/{department}', function (Request $request, Department $department) {
        return response()->json($department);
    });

    // index
    Route::get('/departments', [DepartmentController::class, 'index'])
    ->middleware('auth:sanctum')
    ;

    // Store
    Route::post('/departments', [DepartmentController::class, 'store'])
    ->middleware('auth:sanctum')
    ;

    // Update
    Route::put('/departments/{department}', [DepartmentController::class, 'update'])
    ->middleware('auth:sanctum')
    ;

    // Delete
    Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;

    // USERS
    // Get students of the department
    Route::middleware('auth:sanctum')->get('/departments/{department}/students', function (Request $request, Department $department) {
        return response()->json($department->students());
    });

    // Get postgraduate students of the department
    Route::middleware('auth:sanctum')->get('/departments/{department}/students/postgraduate', function (Request $request, Department $department) {
        return response()->json($department->pg_students());
    });

    // Get undergraduage students of the department
    Route::middleware('auth:sanctum')->get('/departments/{department}/students/undergraduate', function (Request $request, Department $department) {
        return response()->json($department->ug_students());
    });

    // PROGRAMS
    // index
    Route::middleware('auth:sanctum')->get('/departments/{department}/programs', function (Request $request, Department $department) {
        return response()->json($department->programs);
    });

    // Postgraduate Programs
    Route::middleware('auth:sanctum')->get('/departments/{department}/programs/postgraduate', function (Request $request, Department $department) {
        return response()->json($department->pg_programs());
    });

    // Undergraduate Programs
    Route::middleware('auth:sanctum')->get('/departments/{department}/programs/undergraduate', function (Request $request, Department $department) {
        return response()->json($department->ug_programs());
    });

// 6-PROGRAMS
    // Show
    Route::get('/programs/{program}', [ProgramController::class, 'show'])
    ->middleware('auth:sanctum')
    ;

    // index
    Route::get('/programs', [ProgramController::class, 'index'])
    ->middleware('auth:sanctum')
    ;

    // Store
    Route::post('/programs', [ProgramController::class, 'store'])
    ->middleware('auth:sanctum')
    ;

    // Update
    Route::put('/programs/{program}', [ProgramController::class, 'update'])
    ->middleware('auth:sanctum')
    ;

    // Delete
    Route::delete('/programs/{program}', [ProgramController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;

    // TYPES
    // Get Postgraduate programs
    Route::middleware('auth:sanctum')->get('/programs/postgraduate', function (Request $request) {
        return response()->json(Program::pg()->get());
    });

    // Get Undergraduate programs
    Route::middleware('auth:sanctum')->get('/programs/undergraduate', function (Request $request) {
        return response()->json(Program::ug()->get());
    });

    // CLASSGROUPS
    // get all classgroups for the program
    Route::middleware('auth:sanctum')->get('/programs/{program}/classgroups', function (Request $request, Program $program) {
        return response()->json($program->class_groups);
    });
    

    // USERS
    // Get students of the program
    Route::middleware('auth:sanctum')->get('/programs/{program}/students', function (Request $request, Program $program) {
        return response()->json(UserResource::collection($program->students));
    });

// 6.001-PROGRAM STREAM
    // index
    Route::get('/program_streams', [ProgramStreamController::class, 'index'])
    ->middleware('auth:sanctum')
    ;

    // Store
    Route::post('/program_streams', [ProgramStreamController::class, 'store'])
    ->middleware('auth:sanctum')
    ;

    // Update
    Route::put('/program_streams/{program_stream}', [ProgramStreamController::class, 'update'])
    ->middleware('auth:sanctum')
    ;

    // Delete
    Route::delete('/program_streams/{program_stream}', [ProgramStreamController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;

    // Show
    Route::get('/program_streams/{program_stream}', [ProgramStreamController::class, 'show'])
    ->middleware('auth:sanctum')
    ;

    // -- Methods
    // Get Users of the program stream
    Route::middleware('auth:sanctum')->get('/program_streams/{program_stream}/users', function (Request $request, ProgramStream $program_stream) {
        return response()->json($program_stream->users());
    });

    // ClassGroups of the program stream
    Route::middleware('auth:sanctum')->get('/program_streams/{program_stream}/class_groups', function (Request $request, ProgramStream $program_stream) {
        return response()->json($program_stream->class_groups);
    });

// 6.01-ROOM
    // Index
    Route::get('/rooms', [RoomController::class, 'index'])
    ->middleware('auth:sanctum')
    ;

    // Store
    Route::post('/rooms', [RoomController::class, 'store'])
    ->middleware('auth:sanctum')
    ;

    // Update
    Route::put('/rooms/{room}', [RoomController::class, 'update'])
    ->middleware('auth:sanctum')
    ;

    // Delete
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;

    // Show
    Route::get('/rooms/{room}', [RoomController::class, 'show'])
    ->middleware('auth:sanctum')
    ;

    // -- Methods
    // Get Department of a specific room
    Route::middleware('auth:sanctum')->get('/rooms/{room}/department', function (Request $request, Room $room) {
        return response()->json($room->department);
    });

// 6.2-COURSE
    // Show
    Route::get('/courses/{course}', [CourseController::class, 'show'])
    ->middleware('auth:sanctum')
    ;

    // Index
    Route::get('/courses', [CourseController::class, 'index'])
    ->middleware('auth:sanctum')
    ;

    // Store
    Route::post('/courses', [CourseController::class, 'store'])
    ->middleware('auth:sanctum')
    ;

    // Update
    Route::put('/courses/{course}', [CourseController::class, 'update'])
    ->middleware('auth:sanctum')
    ;

    // Delete
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;

    // Methods
    // Get Department of a specific course
    Route::middleware('auth:sanctum')->get('/courses/{course}/department', function (Request $request, Course $course) {
        return response()->json($course->department);
    });

    // Students
    Route::middleware('auth:sanctum')->get('/courses/{course}/students', function (Request $request, Course $course) {
        return response()->json($course->students);
    });

    // ClassGroups
    Route::middleware('auth:sanctum')->get('/courses/{course}/class_groups', function (Request $request, Course $course) {
        return response()->json($course->class_groups());
    });

// 7-CLASSGROUP
    // Show
    Route::get('/classgroups/{classgroup}', [ClassGroupController::class, 'show'])
    ->middleware('auth:sanctum')
    ;

    // Index
    Route::get('/classgroups', [ClassGroupController::class, 'index'])
    ->middleware('auth:sanctum')
    ;

    // Store
    Route::post('/classgroups', [ClassGroupController::class, 'store'])
    ->middleware('auth:sanctum')
    ;

    // Update
    Route::put('/classgroups/{classgroup}', [ClassGroupController::class, 'update'])
    ->middleware('auth:sanctum')
    ;

    // Delete
    Route::delete('/classgroups/{classgroup}', [ClassGroupController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;

    // USERS
    // Get students of the classgroup
    Route::middleware('auth:sanctum')->get('/classgroups/{classgroup}/students', function (Request $request, ClassGroup $classgroup) {
        return response()->json(UserResource::collection($classgroup->users));
    });

    // COURSES
    // Get courses of the classgroup
    Route::middleware('auth:sanctum')->get('/classgroups/{classgroup}/courses', function (Request $request, ClassGroup $classgroup) {
        return response()->json($classgroup->courses);
    });

    // DIVISIONS
    // Get divisions of the classgroup
    Route::middleware('auth:sanctum')->get('/classgroups/{classgroup}/divisions', function (Request $request, ClassGroup $classgroup) {
        return response()->json($classgroup->divisions);
    });


    // Methods
    // Get college of a specific classgroup
    Route::middleware('auth:sanctum')->get('/classgroups/{classgroup}/college', function (Request $request, ClassGroup $classgroup) {
        return response()->json($classgroup->college());
    });

    // Get regular classgroups
    Route::middleware('auth:sanctum')->get('/classgroups-regular', function (Request $request) {
        return response()->json(ClassGroup::regular_classgroups());
    });

    // Get idl classgroups
    Route::middleware('auth:sanctum')->get('/classgroups-idl', function (Request $request) {
        return response()->json(ClassGroup::idl_classgroups());
    });

    // Get parallel classgroups
    Route::middleware('auth:sanctum')->get('/classgroups-parallel', function (Request $request) {
        return response()->json(ClassGroup::parallel_classgroups());
    });


// 7.1-CLASSGROUPDIVISION
    //Index
    Route::get('/classgroup_divisions', [ClassGroupDivisionController::class, 'index'])
    ->middleware('auth:sanctum')
    ;

    //Show
    Route::get('/classgroup_divisions/{classGroupDivision}', [ClassGroupDivisionController::class, 'show'])
    ->middleware('auth:sanctum')
    ;

    //Store
    Route::post('/classgroup_divisions', [ClassGroupDivisionController::class, 'store'])
    ->middleware('auth:sanctum')
    ;

    //Update
    Route::put('/classgroup_divisions/{classGroupDivision}', [ClassGroupDivisionController::class, 'update'])
    ->middleware('auth:sanctum')
    ;

    //Delete
    Route::delete('/classgroup_divisions/{classGroupDivision}', [ClassGroupDivisionController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;

    // USERS
    // Get students of the classgroup division
    Route::middleware('auth:sanctum')->get('/classgroup_divisions/{classGroupDivision}/students', function (Request $request, ClassGroupDivision $classGroupDivision) {
        return response()->json($classGroupDivision->users());
    });

// 8-USERS
    //Index
    Route::get('/users', [UserController::class, 'index'])
    ->middleware('auth:sanctum')
    ;
    
    //Show
    Route::get('/users/{user}', [UserController::class, 'show'])
    ->middleware('auth:sanctum')
    ;

    //Store
    Route::post('/users', [UserController::class, 'store'])
    ->middleware('auth:sanctum')
    ;

    //Update
    Route::put('/users/{user}', [UserController::class, 'update'])
    ->middleware('auth:sanctum')
    ;

    //Delete
    Route::delete('/users/{user}', [UserController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;
    
    // METHODS
    // Get Registered courses of the user
    Route::middleware('auth:sanctum')->get('/users/{user}/registered_courses', function (Request $request, User $user) {
        return response()->json($user->registered_courses);
    });

    // Get Registered Credit hours of the user
    Route::middleware('auth:sanctum')->get('/users/{user}/registered_credit_hours', function (Request $request, User $user) {
        return response()->json($user->registered_credit_hours);
    });

    // Get department of the user
    Route::middleware('auth:sanctum')->get('/users/{user}/department', function (Request $request, User $user) {
        return response()->json($user->department());
    });

    // Get college of the user
    Route::middleware('auth:sanctum')->get('/users/{user}/college', function (Request $request, User $user) {
        return response()->json($user->college());
    });

    // Get roles of the user
    Route::middleware('auth:sanctum')->get('/users/{user}/role', function (Request $request, User $user) {
        return response()->json($user->role);
    });

    // Get regular users
    Route::middleware('auth:sanctum')->get('/users-regular', function (Request $request) {
        return response()->json(User::regular_students());
    });

    // Get idl users
    Route::middleware('auth:sanctum')->get('/users-idl', function (Request $request) {
        return response()->json(User::idl_students());
    });

    // Get parallel Students
    Route::middleware('auth:sanctum')->get('/users-parallel', function (Request $request) {
        return response()->json(User::parallel_students());
    });

// 9-ROLE
    //Index
    Route::get('/roles', [RoleController::class, 'index'])
    ->middleware('auth:sanctum')
    ;

    //Show
    Route::get('/roles/{role}', [RoleController::class, 'show'])
    ->middleware('auth:sanctum')
    ;

    //Store
    Route::post('/roles', [RoleController::class, 'store'])
    ->middleware('auth:sanctum')
    ;

    //Update
    Route::put('/roles/{role}', [RoleController::class, 'update'])
    ->middleware('auth:sanctum')
    ;

    //Delete
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;

    // USERS
    // Get users of the role
    Route::middleware('auth:sanctum')->get('/roles/{role}/users', function (Request $request, Role $role) {
        return response()->json($role->users);
    });

// 10-ROLE-USER
    // Store
    Route::post('/role_users', [RoleUserController::class, 'store'])
    ->middleware('auth:sanctum')
    ;

    // Update
    Route::put('/role_users/{role_user}', [RoleUserController::class, 'update'])
    ->middleware('auth:sanctum')
    ;

    // Delete
    Route::delete('/role_users/{role_user}', [RoleUserController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;

// 10.1-CLASSGROUP COURSES
    //Index
    Route::get('/classgroup_courses', [ClassGroupCourseController::class, 'index'])
    ->middleware('auth:sanctum')
    ;

    //Show
    Route::get('/classgroup_courses/{classgroup_course}', [ClassGroupCourseController::class, 'show'])
    ->middleware('auth:sanctum')
    ;

    // Store
    Route::post('/classgroup_courses', [ClassGroupCourseController::class, 'store'])
    ->middleware('auth:sanctum')
    ;

    // Update
    Route::put('/classgroup_courses/{classgroup_course}', [ClassGroupCourseController::class, 'update'])
    ->middleware('auth:sanctum')
    ;

    // Delete
    Route::delete('/classgroup_courses/{classgroup_course}', [ClassGroupCourseController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;

// 11-COURSE-USER
    // Show
    Route::get('/course_users/{course_user}', [CourseUserController::class, 'show'])
    ->middleware('auth:sanctum')
    ;

    // Store
    Route::post('/course_users', [CourseUserController::class, 'store'])
    ->middleware('auth:sanctum')
    ;

    // Update
    Route::put('/course_users/{course_user}', [CourseUserController::class, 'update'])
    ->middleware('auth:sanctum')
    ;

    // Delete
    Route::delete('/course_users/{course_user}', [CourseUserController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;

// 11.01-SEMESTER-USER
    // StoreOrUpdate
    Route::post('/semester_users', [SemesterUserController::class, 'storeOrUpdate'])
    ->middleware('auth:sanctum')
    ;

    // Delete
    Route::delete('/semester_users', [SemesterUserController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;

// 11.2-SEMESTER-EVENT
    //Index
    Route::get('/semester_events', [SemesterEventController::class, 'index'])
    ->middleware('auth:sanctum')
    ;

    //Show
    Route::get('/semester_events/{semester_event}', [SemesterEventController::class, 'show'])
    ->middleware('auth:sanctum')
    ;

    // Store
    Route::post('/semester_events', [SemesterEventController::class, 'store'])
    ->middleware('auth:sanctum')
    ;

    // Update
    Route::put('/semester_events/{semester_event}', [SemesterEventController::class, 'update'])
    ->middleware('auth:sanctum')
    ;

    // Delete
    Route::delete('/semester_events/{semester_event}', [SemesterEventController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;

// 12-COURSE-SCHEDULE
    //Index
    Route::get('/course_schedules', [CourseScheduleController::class, 'index'])
    ->middleware('auth:sanctum')
    ;

    // Show
    Route::get('/course_schedules/{course_schedule}', [CourseScheduleController::class, 'show'])
    ->middleware('auth:sanctum')
    ;

    // Store
    Route::post('/course_schedules', [CourseScheduleController::class, 'store'])
    ->middleware('auth:sanctum')
    ;

    // Update
    Route::put('/course_schedules/{course_schedule}', [CourseScheduleController::class, 'update'])
    ->middleware('auth:sanctum')
    ;

    // Delete
    Route::delete('/course_schedules/{course_schedule}', [CourseScheduleController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;

// 12.1-SCHEDULE
    // Index
    Route::get('/schedules', [ScheduleController::class, 'index'])
    ->middleware('auth:sanctum')
    ;

    // Show
    Route::get('/schedules/{schedule}', [ScheduleController::class, 'show'])
    ->middleware('auth:sanctum')
    ;

    // Store
    Route::post('/schedules', [ScheduleController::class, 'store'])
    ->middleware('auth:sanctum')
    ;

    // Update
    Route::put('/schedules/{schedule}', [ScheduleController::class, 'update'])
    ->middleware('auth:sanctum')
    ;

    // Delete
    Route::delete('/schedules/{schedule}', [ScheduleController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ;

    