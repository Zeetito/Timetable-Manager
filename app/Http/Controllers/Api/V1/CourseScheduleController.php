<?php

namespace App\Http\Controllers\Api\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\CourseSchedule;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class CourseScheduleController extends Controller
{
    //constant to be replaced later
    const START_TIMES = ['8:00:00', '9:00:00', '10:30:00', '13:00:00', '14:00:00', '15:00:00', '16:00:00', '17:00:00', '18:00:00'];
    const END_TIMES = ['8:55:00', '9:55:00', '10:25:00', '12:25:00', '13:55:00', '14:55:00', '15:55:00', '16:55:00', '17:55:00', '18:55:00'];
    const DAYS = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

    // Index
    public function index(){
        $course_schedules = CourseSchedule::all();
        return response()->json(['data' => $course_schedules], 200);
    }

    // Show
    public function show(CourseSchedule $course_schedule){    
        return response()->json(['data' => $course_schedule], 200);
    }

    // Store
    public function store(Request $request){
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|integer|exists:courses,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room_id' => 'required|integer|exists:rooms,id',
            'day' => 'required|integer',
            'semester_id' => 'required|integer|exists:semesters,id',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        // If validation passes, get the validated data
        $validated = $validator->validated();

         // Calculate the difference between start_time and end_time
        $startTime = Carbon::createFromFormat('H:i', $validated['start_time']);
        $endTime = Carbon::createFromFormat('H:i', $validated['end_time']);
        // Run to the nearest whole number
        $validated['duration'] = round($startTime->diffInMinutes($endTime) / 60, 1);

        // Add to the validated array
        $validated['duration'] = $duration;

        try {
            // Create a new CourseSchedule
            $course_schedule = new CourseSchedule();
            $course_schedule->fill($validated);

            $course_schedule->save();

            return response()->json(['message' => 'CourseSchedule created successfully!', 'data' => $course_schedule], 201);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to store CourseSchedule due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Update
    public function update(Request $request, CourseSchedule $course_schedule)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|integer|exists:courses,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'duration' => 'nullable|numeric',
            'room_id' => 'required|integer|exists:rooms,id',
            'day' => 'required|integer|max:10',
            'semester_id' => 'required|integer|exists:semesters,id',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();

        // Update the duration as well
        $startTime = Carbon::createFromFormat('H:i', $validated['start_time']);
        $endTime = Carbon::createFromFormat('H:i', $validated['end_time']);
        // Run to the nearest whole number
        $validated['duration'] = round($startTime->diffInMinutes($endTime) / 60, 1);
        // Add to the validated array
        $validated['duration'] = (double) $duration;
        
        try {
            // Update the CourseSchedule
            $course_schedule->fill($validated);
            $course_schedule->save();

            return response()->json(['message' => 'CourseSchedule updated successfully!', 'data' => $course_schedule], 200);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to update CourseSchedule due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Destroy
    public function destroy(CourseSchedule $course_schedule)
    {
        try {
            $course_schedule->delete();
            return response()->json(['message' => 'CourseSchedule deleted successfully!'], 200);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to delete CourseSchedule due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Schedule courses for a particular stream
    public function scheduleCoursesForStream(array $courses, String $string){
        // NB: Semester is active semester
        foreach($courses as $course){
            $classGroups = $course->class_groups_of_stream($string);
            $totalStudents = $classGroups->sum('students_count');
            $staff = $course->staff();
        }

        // Priority 1: Get classrooms in the department
        $availableClassrooms = $course->department->rooms()
        ->where('capacity', '>=', $totalStudents)
        ->get();


        // Try finding a room in the department first
        $isRoomFound = findAvailableRoom($availableClassrooms, $classGroups, $staff, $semesterId, $course);

        // Priority 2: If no room is found, expand to all classrooms in the college
        if (!$isRoomFound) {
            $availableClassrooms = $course->college->rooms()
                                    ->where('capacity', '>=', $totalStudents)
                                    ->get();
            
            findAvailableRoom($availableClassrooms, $classGroups, $staff, $semesterId, $course);
        }

            // Find Available Room Function
            function findAvailableRoom($availableClassrooms, $classGroups, $staff, $semesterId, $course)
            {
                // Calculate the total duration of the course based on credit hours
                $remainingDuration = $course->credit_hour * 60; // Convert credit hours to minutes
                $maxDurationPerSlot = 120; // Maximum 2 hours per slot in minutes
            
                foreach (CourseSchedule::DAYS as $day) {
                    foreach ($availableClassrooms as $room) {
                        for ($i = 0; $i < count(CourseSchedule::START_TIMES); $i++) {
                            $startTime = CourseSchedule::START_TIMES[$i];
                            
                            // Loop through possible end times starting from the current $i position to find the longest suitable duration
                            for ($j = $i; $j < count(CourseSchedule::END_TIMES); $j++) {
                                $endTime = CourseSchedule::END_TIMES[$j];
            
                                // Calculate the duration between the start and end times
                                $slotDuration = Carbon::parse($startTime)->diffInMinutes(Carbon::parse($endTime));
            
                                // Check if the current slot can accommodate part of the required duration
                                if ($slotDuration > 0 && $slotDuration <= $maxDurationPerSlot && $slotDuration <= $remainingDuration) {
                                    $isRoomAvailable = checkRoomAvailability($room, $day, $startTime, $endTime);
                                    $isClassGroupAvailable = checkClassGroupAvailability($classGroups, $day, $startTime, $endTime);
                                    
                                    $isStaffAvailable = true;
                                    if ($staff) {
                                        $isStaffAvailable = checkStaffAvailability($staff, $day, $startTime, $endTime);
                                    }
            
                                    if ($isRoomAvailable && $isClassGroupAvailable && $isStaffAvailable) {
                                        // Assign the schedule for this block duration
                                        CourseSchedule::create([
                                            'course_id' => $course->id,
                                            'start_time' => $startTime,
                                            'end_time' => $endTime,
                                            'stream' => $string,
                                            'room_id' => $room->id,
                                            'day' => $day,
                                            'semester_id' => Semester::getActiveSemester()->id
                                        ]);
            
                                        // Subtract the block duration from the remaining duration
                                        $remainingDuration -= $slotDuration;
            
                                        // If all required hours are scheduled, exit the loop
                                        if ($remainingDuration <= 0) {
                                            return true; // Return true if all blocks are scheduled
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                return false; // Return false if no room was found for the remaining duration
            }

            // Check Room Availability
            function checkRoomAvailability($room, $day, $startTime, $endTime)
            {
                // Query the CourseSchedule table to see if the room is already booked for the given day and time
                $conflict = CourseSchedule::where('room_id', $room->id)
                            ->where('day', $day)
                            ->where(function ($query) use ($startTime, $endTime) {
                                $query->whereBetween('start_time', [$startTime, $endTime])
                                    ->orWhereBetween('end_time', [$startTime, $endTime])
                                    ->orWhere(function ($q) use ($startTime, $endTime) {
                                        // This checks if the schedule overlaps the entire period
                                        $q->where('start_time', '<=', $startTime)
                                            ->where('end_time', '>=', $endTime);
                                    });
                            })->exists();
                
                return !$conflict; // Return true if no conflict was found, meaning the room is available
            }

            // Check Classgroups Availability
            function checkClassGroupAvailability($classGroups, $day, $startTime, $endTime)
            {
                // Loop through each class group and check if any has a conflicting schedule
                foreach ($classGroups as $classGroup) {
                    $conflict = CourseSchedule::where('class_group_id', $classGroup->id)
                                ->where('day', $day)
                                ->where(function ($query) use ($startTime, $endTime) {
                                    $query->whereBetween('start_time', [$startTime, $endTime])
                                        ->orWhereBetween('end_time', [$startTime, $endTime])
                                        ->orWhere(function ($q) use ($startTime, $endTime) {
                                            // Check if the class group has another course fully overlapping this period
                                            $q->where('start_time', '<=', $startTime)
                                                ->where('end_time', '>=', $endTime);
                                        });
                                })->exists();
                    
                    if ($conflict) {
                        return false; // If any conflict is found for any class group, return false
                    }
                }

                return true; // No conflicts found, the class group is available
            }

            // Check Staff Availability
            function checkStaffAvailability($staff, $day, $startTime, $endTime)
            {
                // Query the CourseSchedule table to see if the staff is already assigned to another course at the same time
                $conflict = $staff->course_schedules()
                            ->where('day', $day)
                            ->where(function ($query) use ($startTime, $endTime) {
                                $query->whereBetween('start_time', [$startTime, $endTime])
                                    ->orWhereBetween('end_time', [$startTime, $endTime])
                                    ->orWhere(function ($q) use ($startTime, $endTime) {
                                        // Check if the staff member has another course fully overlapping this period
                                        $q->where('start_time', '<=', $startTime)
                                            ->where('end_time', '>=', $endTime);
                                    });
                            })->exists();
                
                return !$conflict; // Return true if no conflict is found, meaning the staff is available
            }

    }

    // Dispatch Job to Begin Schedule for a given Stream
    public function dispatchCourseScheduleJobForStream(String $stream){
        ini_set('max_execution_time', '120');
        $courses_to_be_scheduled_for_stream = Course::courses_to_be_scheduled_for_stream($stream);
        $courses_id = $courses_to_be_scheduled_for_stream->pluck('id');

        // Cache them

    }







}
