<?php

namespace App\Http\Controllers\Api\V1;

use Carbon\Carbon;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    // Index
    public function index(){
        $schedules = Schedule::all();
        return response()->json(['data' => $schedules], 200);
    }

    // Show
    public function show(Schedule $schedule){    
        return response()->json(['data' => $schedule], 200);
    }

    // Store
    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'scheduleable_id' => 'required|integer',
            'scheduleable_type' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'duration' => 'nullable|numeric|min:0',
            'room_id' => 'nullable|integer|exists:rooms,id',
            'lecturer_id' => 'nullable|integer|exists:users,id',
            'date' => 'nullable|date',
            'semester_id' => 'required|integer|exists:semesters,id',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        // Check if the scheduleable instance exists
        $instance = $scheduleableModel = app($request->scheduleable_type)::find($request->scheduleable_id);
        if (!$instance) {
            return response()->json([
                'error' => 'The Instance of Schedule Not found'
            ], 404);
        }

        try {
            // Calculate the duration if not provided
            $validated = $validator->validated();
            if (empty($validated['duration']) && !empty($validated['start_time']) && !empty($validated['end_time'])) {
                $startTime = Carbon::createFromFormat('H:i', $validated['start_time']);
                $endTime = Carbon::createFromFormat('H:i', $validated['end_time']);
                $validated['duration'] = round($startTime->diffInMinutes($endTime) / 60, 1); // Duration in hours with 1 decimal place
            }

            // Create a new Schedule
            $schedule = new Schedule();
            $schedule->fill($validated);
            $schedule->save();

            return response()->json(['message' => 'Schedule created successfully!', 'data' => $schedule], 201);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to store Schedule due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }


    // Update
    public function update(Request $request, Schedule $schedule)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'scheduleable_id' => 'required|integer',
            'scheduleable_type' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'duration' => 'nullable|numeric|min:0',
            'room_id' => 'nullable|integer|exists:rooms,id',
            'lecturer_id' => 'nullable|integer|exists:users,id',
            'date' => 'nullable|date',
            'semester_id' => 'required|integer|exists:semesters,id',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        // Check if the scheduleable instance exists
        $instance = $scheduleableModel = app($request->scheduleable_type)::find($request->scheduleable_id);
        if (!$instance) {
            return response()->json([
                'error' => 'The Instance of Schedule Not found'
            ], 404);
        }

        try {
            // Calculate the duration if not provided
            $validated = $validator->validated();
            if (empty($validated['duration']) && !empty($validated['start_time']) && !empty($validated['end_time'])) {
                $startTime = Carbon::createFromFormat('H:i', $validated['start_time']);
                $endTime = Carbon::createFromFormat('H:i', $validated['end_time']);
                $validated['duration'] = round($startTime->diffInMinutes($endTime) / 60, 1); // Duration in hours with 1 decimal place
            }

            // Update the Schedule
            $schedule->fill($validated);
            $schedule->save();

            return response()->json(['message' => 'Schedule updated successfully!', 'data' => $schedule], 200);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to update Schedule due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }


    // Delete
    public function destroy(Schedule $schedule)
    {
        try {
            $schedule->delete();
            return response()->json(['message' => 'Schedule deleted successfully!'], 200);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to delete Schedule due to a database error: ' . $e->getMessage()
            ], 500);
        }
}

}
