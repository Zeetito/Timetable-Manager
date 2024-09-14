<?php

namespace App\Http\Controllers\Api\V1;

use Carbon\Carbon;
use App\Models\Semester;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class SemesterController extends Controller
{

    public function show(Semester $semester){
        return response()->json(['data' => $semester], 200);
    }
    // Index
    public function index(){
        $semesters = \App\Models\Semester::all();
        return response()->json(['data' => $semesters], 200);
    }

    // Store
    public function store(Request $request){
        // Validate the request
        $validated = $request->validate([
            'value' => [
                'required',
                Rule::in(['1', '2', '3']), // Enum constraint validation
            ],
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        
        // Check if the incoming start date is less than the previous enddate
        $previous_semester = Semester::latest()->first();
        $date1 = Carbon::createFromFormat('Y-m-d', $validated['start_date']);
        $date2 = Carbon::createFromFormat('Y-m-d', $previous_semester->end_date);

        if ($date1 < $date2) {
            return response()->json(['error' => 'Use A Valid date.'], 422);
        }

        // If the semester being Created is a first sem, it must come with a new Academic year
        if($validated['value'] == '1'){
            $academic_year = new AcademicYear();
            $academic_year->start_year = $request->start_year;
            $academic_year->end_year = $request->end_year;
            $academic_year->save();
        }

        if(isset($academic_year)){
            $validated['academic_year_id'] = $academic_year->id;
        }else{
            $validated['academic_year_id'] = Semester::getActiveSemester()->academic_year_id;
        }

        $semester =  new Semester();
        $semester->value = $validated['value'];
        $semester->start_date = $validated['start_date'];
        $semester->end_date = $validated['end_date'];
        $semester->academic_year_id = $validated['academic_year_id'];

        try {
            if ($semester->save()) {
                // If save is successful
                return response()->json(['message' => 'New Semester Year created successfully!', 'data' => $semester], 201);
            } else {
                // If save fails, return a general error
                return response()->json(['error' => 'Failed to save the Semester.'], 500);
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return response()->json(['error' => 'Duplicate entry, the semester already exists.'], 409);
            }
            return response()->json(['error' => 'Failed to create semester due to database error: ' . $e->getMessage()], 500);
        }
    }

    // Update
    public function update(Request $request, Semester $semester){
        // Create a validator instance
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            // If validation fails, return a custom error response
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        };

        $validated = $validator->validated();

        $previous_semester = Semester::where('id', '<', $semester->id)->latest()->first();

            // Check if the incoming start date is less than the previous enddate
            $date1 = Carbon::createFromFormat('Y-m-d', $validated['start_date']);
            $date2 = Carbon::createFromFormat('Y-m-d', $previous_semester->end_date);

            if ($date1 < $date2) {
                return response()->json(['error' => 'Use A Valid date.'], 422);
            }
        

        $semester->start_date = $validated['start_date'];
        $semester->end_date = $validated['end_date'];

        try {
            if ($semester->save()) {
                return response()->json(['message' => 'Semester updated successfully!', 'data' => $semester], 200);
            } else {
                return response()->json(['error' => 'Failed to update the semester.'], 500);
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return response()->json(['error' => 'Duplicate entry, the semester already exists.'], 409);
            }
            return response()->json(['error' => 'Failed to update semester due to database error: ' . $e->getMessage()], 500);
        }
    }

    // Delete
    public function destroy(Semester $semester){
        // Check if the Semester being deleted is active
        if($semester->is_active){
            $previous_semester = Semester::where('id', '<', $semester->id)->latest()->first();
            $previous_semester->is_active = 1;
        }

        if($semester->delete()){
            if(isset($previous_semester)){
                $previous_semester->save();
            }
            return response()->json(['message' => 'Semester deleted successfully!'], 200);
        }else{
            return response()->json(['error' => 'Failed to delete the semester.'], 500);
        }
    }
}
