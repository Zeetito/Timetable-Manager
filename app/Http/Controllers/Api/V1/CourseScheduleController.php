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





}
