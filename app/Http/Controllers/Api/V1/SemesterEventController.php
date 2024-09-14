<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\SemesterEvent;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class SemesterEventController extends Controller
{
    // Index
    public function index(){
        $semester_events = SemesterEvent::all();
        return response()->json(['data' => $semester_events], 200);
    }

    // Show
    public function show(SemesterEvent $semester_event){    
        return response()->json(['data' => $semester_event], 200);
    }

    // Store
    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'semester_id' => 'required|integer|exists:semesters,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        try {
            // Create a new SemesterEvent
            $validated = $validator->validated();
            $semester_event = new SemesterEvent();
            $semester_event->fill($validated);
            $semester_event->save();

            return response()->json(['message' => 'SemesterEvent created successfully!', 'data' => $semester_event], 201);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to store SemesterEvent due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Update
    public function update(Request $request, SemesterEvent $semester_event)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'semester_id' => 'required|integer|exists:semesters,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        try {
            // Update the SemesterEvent
            $validated = $validator->validated();
            $semester_event->fill($validated);
            $semester_event->save();

            return response()->json(['message' => 'SemesterEvent updated successfully!', 'data' => $semester_event], 200);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to update SemesterEvent due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Delete
    public function destroy(SemesterEvent $semester_event)
    {
        try {
            $semester_event->delete();
            return response()->json(['message' => 'SemesterEvent deleted successfully!'], 200);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to delete SemesterEvent due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }




}
