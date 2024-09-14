<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\ClassGroupCourse;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class ClassGroupCourseController extends Controller
{

    // Index
    public function index(){
        $classgroup_courses = ClassGroupCourse::all();
        return response()->json(['data' => $classgroup_courses], 200);
    }

    // Show
    public function show(ClassGroupCourse $classgroup_course){    
        return response()->json(['data' => $classgroup_course], 200);
    }

    // Store
    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'class_group_id' => 'required|integer|exists:class_groups,id',
            'course_id' => 'required|integer|exists:courses,id',
            'is_elective' => 'required|boolean',
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
            // Create a new ClassGroupCourse
            $validated = $validator->validated();
            $classgroup_course = new ClassGroupCourse();
            $classgroup_course->fill($validated);
            $classgroup_course->save();

            return response()->json(['message' => 'ClassGroupCourse created successfully!', 'data' => $classgroup_course], 201);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to store ClassGroupCourse due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Update
    public function update(Request $request, ClassGroupCourse $classgroup_course)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'class_group_id' => 'required|integer|exists:class_groups,id',
            'course_id' => 'required|integer|exists:courses,id',
            'is_elective' => 'required|boolean',
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
            // Update the ClassGroupCourse
            $validated = $validator->validated();
            $classgroup_course->fill($validated);
            $classgroup_course->save();

            return response()->json(['message' => 'ClassGroupCourse updated successfully!', 'data' => $classgroup_course], 200);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to update ClassGroupCourse due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }


    // Destroy
    public function destroy(ClassGroupCourse $classgroup_course)
    {
        try {
            $classgroup_course->delete();
            return response()->json(['message' => 'ClassGroupCourse deleted successfully!'], 200);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Failed to delete ClassGroupCourse due to a database error: ' . $e->getMessage()
            ], 500);
        }
    }



}
