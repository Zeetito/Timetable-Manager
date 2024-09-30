<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\CourseUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class CourseUserController extends Controller
{
    // Show
    public function show(CourseUser $course_user){
        return response()->json(['data' => $course_user], 200);
    }
    // Store
    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'course_id' => 'required|integer|exists:courses,id',
            'midsem_score' => 'nullable|numeric|min:0|max:100',
            'assessment_score' => 'nullable|numeric|min:0|max:100',
            'exam_score' => 'nullable|numeric|min:0|max:100',
            'total_score' => 'nullable|numeric|min:0|max:100',
            'semester_id' => 'required|integer|exists:semesters,id',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        try {
            // Create a new CourseUser
            $validated = $validator->validated();
            $course_user = new CourseUser();
            $course_user->fill($validated);
            $course_user->save();

            return response()->json(['message' => 'CourseUser created successfully!', 'data' => $course_user], 201);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to store CourseUser due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Update
    public function update(Request $request, CourseUser $course_user)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'course_id' => 'required|integer|exists:courses,id',
            'midsem_score' => 'nullable|numeric|min:0|max:100',
            'assessment_score' => 'nullable|numeric|min:0|max:100',
            'exam_score' => 'nullable|numeric|min:0|max:100',
            'total_score' => 'nullable|numeric|min:0|max:100',
            'semester_id' => 'required|integer|exists:semesters,id',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        try {
            // Update the CourseUser
            $validated = $validator->validated();
            $course_user->fill($validated);
            $course_user->save();

            return response()->json(['message' => 'CourseUser updated successfully!', 'data' => $course_user], 200);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to update CourseUser due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Delete
    public function destroy(CourseUser $course_user)
    {
        try {
            $course_user->delete();
            return response()->json(['message' => 'CourseUser deleted successfully!'], 200);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to delete CourseUser due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }



}
