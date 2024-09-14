<?php

namespace App\Http\Controllers\Api\V1;

use Carbon\Carbon;
use App\Models\ClassGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ClassGroupController extends Controller
{

    // Show
    public function show(ClassGroup $classgroup){
        return response()->json(['data' => $classgroup], 200);
    }

    // Index
    public function index(){
        $classGroups = ClassGroup::all();
        return response()->json(['data' => $classGroups], 200);
    }

    // Store
    public function store(Request $request){
        // Create a validator instance
        $validator = Validator::make($request->all(), [
            'program_id' => 'required|integer',
            'year' => 'required|integer',
            'start_year' => 'required|date',
            'end_year' => 'required|date|gte:start_year',  // Ensure end_year is greater than or equal to start_year
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

        $classgroup = new ClassGroup();
        $classgroup->program_id = $validated['program_id'];
        $classgroup->year = $validated['year'];
        $classgroup->start_year = $validated['start_year'];
        $classgroup->end_year = $validated['end_year'];

        try {
            if ($classgroup->save()) {
                return response()->json(['message' => 'ClassGroup created successfully!', 'data' => $classgroup], 201);
            } else {
                return response()->json(['error' => 'Failed to save the ClassGroup.'], 500);
            }
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to create ClassGroup due to database error: ' . $e->getMessage()], 500);
        }
    }

    // Update
    public function update(Request $request, ClassGroup $classgroup){
        // Create a validator instance
        $validator = Validator::make($request->all(), [
            'program_id' => 'required|integer',
            'year' => 'required|integer',
            'start_year' => 'required|date',
            'end_year' => 'required|date|gte:start_year',  // Ensure end_year is greater than or equal to start_year
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

        // Update classgroup attributes
        $classgroup->program_id = $validated['program_id'];
        $classgroup->year = $validated['year'];
        $classgroup->start_year = Carbon::createFromDate($validated['start_year'], 1, 1)->format('Y-m-d');
        $classgroup->end_year = Carbon::createFromDate($validated['end_year'], 1, 1)->format('Y-m-d');

        try {
            if ($classgroup->save()) {
                return response()->json(['message' => 'ClassGroup updated successfully!', 'data' => $classgroup], 200);
            } else {
                return response()->json(['error' => 'Failed to update the ClassGroup.'], 500);
            }
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to update ClassGroup due to database error: ' . $e->getMessage()], 500);
        }
    }

    // Delete
    public function destroy(ClassGroup $classgroup){
        try {
            // Attempt to delete the class group
            if ($classgroup->delete()) {
                return response()->json(['message' => 'ClassGroup deleted successfully!'], 200);
            } else {
                return response()->json(['error' => 'Failed to delete the ClassGroup.'], 500);
            }
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to delete ClassGroup due to database error: ' . $e->getMessage()], 500);
        }
    }



}
