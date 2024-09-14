<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class AcademicYearController extends Controller
{
    // Show
    public function show(AcademicYear $academic_year){
        return response()->json(['data' => $academic_year], 200);
    }
    
    // Index
    public function index(){
        $academic_years = AcademicYear::all();
        return response()->json(['data' => $academic_years], 200);
    }
    // Store
    public function store(Request $request){
        $validated = $request->validate([
            'start_year' => 'required',
            'end_year' => 'required'
        ]);

        $academic_year = new AcademicYear();
        $academic_year->start_year = $validated['start_year'];
        $academic_year->end_year = $validated['end_year'];
    
        try {
            if ($academic_year->save()) {
                // If save is successful
                return response()->json(['message' => 'Academic Year created successfully!', 'data' => $academic_year], 201);
            } else {
                // If save fails, return a general error
                return response()->json(['error' => 'Failed to save the academic year.'], 500);
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return response()->json(['error' => 'Duplicate entry, the academic year already exists.'], 409);
            }
            return response()->json(['error' => 'Failed to create academic year due to database error: ' . $e->getMessage()], 500);
        }
    }

    // Update
    public function update(Request $request, AcademicYear $academic_year){
        // Create a validator instance
        $validator = Validator::make($request->all(), [
            'start_year' => 'required|unique:academic_years,start_year,',
            'end_year' => 'required'
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            // If validation fails, return a custom error response
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }
    
        // Extract validated data
        $validated = $validator->validated();
    
        $academic_year->start_year = $validated['start_year'];
        $academic_year->end_year = $validated['end_year'];
    
        try {
            if ($academic_year->save()) {
                return response()->json(['message' => 'Academic Year updated successfully!', 'data' => $academic_year], 200);
            } else {
                return response()->json(['error' => 'Failed to update the academic year.'], 500);
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return response()->json(['error' => 'Duplicate entry, the academic year already exists.'], 409);
            }
            return response()->json(['error' => 'Failed to update academic year due to database error: ' . $e->getMessage()], 500);
        }
    }

    // Destroy
    public function destroy(AcademicYear $academic_year){
        if ($academic_year->delete()) {
            return response()->json(['message' => 'Academic Year deleted successfully!'], 200);
        } else {
            return response()->json(['error' => 'Failed to delete the academic year.'], 500);
        }
    }
}
