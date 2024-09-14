<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    // Show
    public function show(Course $course){
        return response()->json(['data' => $course], 200);
    }

    // Index
    public function index(){
        $courses = Course::all();
        return response()->json(['data' => $courses], 200);
    }

    // Store
    public function store(Request $request){
        // Create a validator instance
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required|unique:courses,code',
            'credit_hour' => 'required|integer',
            'lecturers_id' => 'nullable',
            'department_id' => 'nullable',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // If validation fails, return a custom error response
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        // If validation passes, get the validated data
        $validated = $validator->validated();

        $course = new Course();
        $course->name = $validated['name'];
        $course->code = $validated['code'];
        $course->credit_hour = $validated['credit_hour'];
        $course->lecturers_id = $validated['lecturers_id'];
        $course->department_id = $validated['department_id'];

        try {
            if ($course->save()) {
                return response()->json(['message' => 'Course created successfully!', 'data' => $course], 201);
            } else {
                return response()->json(['error' => 'Failed to save the course.'], 500);
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return response()->json(['error' => 'Duplicate entry, the course already exists.'], 409);
            }
            return response()->json(['error' => 'Failed to create course due to database error: ' . $e->getMessage()], 500);
        }
    }

    // Update
    public function update(Request $request, Course $course){
        // Create a validator instance
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required|unique:courses,code,' . $course->id,
            'credit_hour' => 'required|integer',
            'lecturers_id' => 'nullable',
            'department_id' => 'nullable',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        // Get the validated data
        $validated = $validator->validated();

        // Update course attributes
        $course->name = $validated['name'];
        $course->code = $validated['code'];
        $course->credit_hour = $validated['credit_hour'];
        $course->lecturers_id = $validated['lecturers_id'];
        $course->department_id = $validated['department_id'];

        try {
            if ($course->save()) {
                return response()->json(['message' => 'Course updated successfully!', 'data' => $course], 200);
            } else {
                return response()->json(['error' => 'Failed to update the course.'], 500);
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return response()->json(['error' => 'Duplicate entry, the course already exists.'], 409);
            }
            return response()->json(['error' => 'Failed to update course due to database error: ' . $e->getMessage()], 500);
        }
    }

    // Delete
    public function destroy(Course $course){
        try {
            // Attempt to delete the course
            if ($course->delete()) {
                return response()->json(['message' => 'Course deleted successfully!'], 200);
            } else {
                return response()->json(['error' => 'Failed to delete the course.'], 500);
            }
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to delete course due to database error: ' . $e->getMessage()], 500);
        }
    }



}
