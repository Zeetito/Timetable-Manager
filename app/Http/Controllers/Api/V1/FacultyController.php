<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class FacultyController extends Controller
{

    // Show
    public function show(Faculty $faculty){
        return response()->json(['data' => $faculty], 200);
    }
    // Index
    public function index(){
        $faculties = Faculty::all();
        return response()->json(['data' => $faculties], 200);
    }

    // Store
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'college_id' => 'required',
            'location' => 'nullable',
        ]);

        $faculty = new Faculty();
        $faculty->name = $validated['name'];
        $faculty->college_id = $validated['college_id'];
        $faculty->location = $validated['location'];
    
        try {
            if ($faculty->save()) {
                // If save is successful
                return response()->json(['message' => 'Faculty created successfully!', 'data' => $faculty], 201);
            } else {
                // If save fails, return a general error
                return response()->json(['error' => 'Failed to save the faculty.'], 500);
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return response()->json(['error' => 'Duplicate entry, the faculty already exists.'], 409);
            }
            return response()->json(['error' => 'Failed to create faculty due to database error: ' . $e->getMessage()], 500);
        }

    }

    // Update
    public function update(Request $request, Faculty $faculty){
        // Create a validator instance
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:faculties,name,',
            'college_id' => 'required',
            'location' => 'nullable',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            // If validation fails, return a custom error response
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();

        $faculty->name = $validated['name'];
        $faculty->college_id = $validated['college_id'];
        $faculty->location = $validated['location'];


        try{
            if($faculty->save()){
                return response()->json(['message' => 'Faculty updated successfully!', 'data' => $faculty], 200);
            }else{
                return response()->json(['error' => 'Failed to update the faculty.'], 500);
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return response()->json(['error' => 'Duplicate entry, the faculty already exists.'], 409);
            }
            return response()->json(['error' => 'Failed to update faculty due to database error: ' . $e->getMessage()], 500);
        }
    }

    // Destroy
    public function destroy(Request $request, Faculty $faculty){
        if($faculty->delete()){
            return response()->json(['message' => 'Faculty deleted successfully!'], 200);
        }else{
            return response()->json(['error' => 'Failed to delete the faculty.'], 500);
        }
    }
}
