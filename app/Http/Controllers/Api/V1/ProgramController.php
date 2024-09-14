<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{

    // Show
    public function show(Program $program){
        return response()->json(['data' => $program], 200);
    }

    public function index(){
        $programs = Program::all();
        return response()->json(['data' => $programs], 200);
    }

        // Store
        public function store(Request $request){
            $validated = $request->validate([
                'name' => 'required',
                'college_id' => 'required',
                'faculty_id' => 'nullable',
                'department_id' => 'nullable',
                'type' => 'required',
                'span' => 'nullable',
            ]);
    
            $program = new Program();
            $program->name = $validated['name'];
            $program->faculty_id = $validated['faculty_id'];
            $program->department_id = $validated['department_id'];
            $program->college_id = $validated['college_id'];
            $program->type = $validated['type'];
            $program->span = $validated['span'];
        
            try {
                if ($program->save()) {
                    // If save is successful
                    return response()->json(['message' => 'Program created successfully!', 'data' => $program], 201);
                } else {
                    // If save fails, return a general error
                    return response()->json(['error' => 'Failed to save the program.'], 500);
                }
            } catch (QueryException $e) {
                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    return response()->json(['error' => 'Duplicate entry, the program already exists.'], 409);
                }
                return response()->json(['error' => 'Failed to create program due to database error: ' . $e->getMessage()], 500);
            }
    
        }

            // Update
    public function update(Request $request, Program $program){
        // Create a validator instance
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:programs,name,',
            'faculty_id' => 'nullable',
            'department_id' => 'nullable',
            'college_id' => 'required',
            'span' => 'nullable',
            'type' => 'required',
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

        $program->name = $validated['name'];
        $program->college_id = $validated['college_id'];
        $program->department_id = $validated['department_id'];
        $program->faculty_id = $validated['faculty_id'];
        $program->span = $validated['span'];
        $program->type = $validated['type'];


        try{
            if($program->save()){
                return response()->json(['message' => 'Program updated successfully!', 'data' => $program], 200);
            }else{
                return response()->json(['error' => 'Failed to update the program.'], 500);
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return response()->json(['error' => 'Duplicate entry, the program already exists.'], 409);
            }
            return response()->json(['error' => 'Failed to update program due to database error: ' . $e->getMessage()], 500);
        }
    }

    // Delete
    public function destroy(Program $program){
        if($program->delete()){
            return response()->json(['message' => 'Program deleted successfully!'], 200);
        }else{
            return response()->json(['error' => 'Failed to delete the program.'], 500);
        }
    }
    

    
}
