<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{

    public function index(){
        $departments = Department::all();
        return response()->json(['data' => $departments], 200);
    }

    // Store
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'college_id' => 'required',
            'faculty_id' => 'nullable',
            'location' => 'nullable',
        ]);

        $department = new Department();
        $department->name = $validated['name'];
        $department->faculty_id = $validated['faculty_id'];
        $department->college_id = $validated['college_id'];
        $department->location = $validated['location'];
    
        try {
            if ($department->save()) {
                // If save is successful
                return response()->json(['message' => 'Department created successfully!', 'data' => $department], 201);
            } else {
                // If save fails, return a general error
                return response()->json(['error' => 'Failed to save the department.'], 500);
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return response()->json(['error' => 'Duplicate entry, the department already exists.'], 409);
            }
            return response()->json(['error' => 'Failed to create department due to database error: ' . $e->getMessage()], 500);
        }

    }

    // Update
    public function update(Request $request, Department $department){
        // Create a validator instance
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:departments,name,',
            'faculty_id' => 'nullable',
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

        $department->name = $validated['name'];
        $department->college_id = $validated['college_id'];
        $department->faculty_id = $validated['faculty_id'];
        $department->location = $validated['location'];


        try{
            if($department->save()){
                return response()->json(['message' => 'Department updated successfully!', 'data' => $department], 200);
            }else{
                return response()->json(['error' => 'Failed to update the department.'], 500);
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return response()->json(['error' => 'Duplicate entry, the department already exists.'], 409);
            }
            return response()->json(['error' => 'Failed to update department due to database error: ' . $e->getMessage()], 500);
        }
    }

    // Delete
    public function destroy(Department $department){
        if($department->delete()){
            return response()->json(['message' => 'Department deleted successfully!'], 200);
        }else{
            return response()->json(['error' => 'Failed to delete the department.'], 500);
        }
    }

    // Show
    public function show(Department $department){
        return response()->json(['data' => $department], 200);
    }
}
